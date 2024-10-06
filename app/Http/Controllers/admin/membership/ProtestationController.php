<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProtestationRequest;
use App\Http\Resources\membership\ProtestationResource;
use App\Models\membership\Document;
use App\Models\membership\Protestation;
use App\Models\membership\ProtestationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function App\Helpers\to_georgian;

class ProtestationController extends Controller
{
    public function index(Document $document)
    {
        $protestations = $document->protestations()
            ->select(['id', 'protestation_number', 'protestation_date', 'protestation_text', 'document_id', 'protestation_status_id', 'status'])
            ->with(['files',
                'protestationStatus:id,name'])
            ->where('protestation_number', 'like', $this->search)
            ->paginate($this->first);

        return ProtestationResource::collection($protestations);
    }


    public function store(ProtestationRequest $request, Document $document)
    {
        $inputs = $request->all();
        $inputs['protestation_date'] = to_georgian($request->protestation_date);

        $inputs['protestation_text'] = $inputs['protestation_text'] ?? '';

        $protestation = $document->protestations()->create($inputs);

        if ($request->hasFile('files')){
            foreach ($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($protestation->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/protestation/$protestation->id";

                Storage::putFileAs($path, $file, $fileName);

                $protestation->files()->create([
                   'mime_type' => $file->extension(),
                   'size' => $file->getSize() / 1024,
                   'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function show(Document $document, Protestation $protestation)
    {
        return new ProtestationResource($protestation->load(['files', 'protestationStatus']));
    }


    public function update(ProtestationRequest $request, Document $document, Protestation $protestation)
    {
        $inputs = $request->all();
        $inputs['protestation_date'] = to_georgian($request->protestation_date);
        $inputs['protestation_text'] = $inputs['protestation_text'] ?? '';

        $protestation->update($inputs);

        if ($request->hasFile('files')){
            foreach ($protestation->files as $file){
                Storage::delete($file->path);
                $file->delete();
            }

            foreach ($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($protestation->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/protestation/$protestation->id";

                Storage::putFileAs($path, $file, $fileName);

                $protestation->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function destroy(Document $document, Protestation $protestation)
    {
        if ($protestation->files){
            foreach ($protestation->files as $file){
                if (Storage::disk('public')->exists($file->path)){
                    Storage::disk('public')->delete($file->path);
                }
                $file->delete();
            }
        }
        $protestation->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
           'protestationStatuses' => ProtestationStatus::select(['id', 'name'])->get(),
        ]);
    }
}
