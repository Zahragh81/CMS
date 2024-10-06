<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\RulingRequest;
use App\Http\Resources\membership\RulingResource;
use App\Models\membership\Document;
use App\Models\membership\Ruling;
use App\Models\membership\RulingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function App\Helpers\to_georgian;

class RulingController extends Controller
{
    public function index(Document $document)
    {
        $rulings = $document->rulings()
        ->select(['id', 'judgment_number', 'judgment_date', 'judgment_text', 'status', 'document_id', 'ruling_status_id'])
        ->with(['files',
            'rulingStatus:id,name'])
        ->where('judgment_number', 'like', $this->search)
        ->paginate($this->first);

        return RulingResource::collection($rulings);
    }


    public function store(RulingRequest $request, Document $document)
    {
        $inputs = $request->all();
        $inputs['judgment_date'] = to_georgian($request->judgment_date);
        $inputs['judgment_text'] = $inputs['judgment_text'] ?? '';

        $ruling = $document->rulings()->create($inputs);

        if ($request->hasFile('files')){
            foreach ($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($ruling->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/ruling/$ruling->id";

                Storage::putFileAs($path, $file, $fileName);

                $ruling->files()->create([
                   'mime_type' => $file->extension(),
                   'size' => $file->getSize() / 1024,
                   'path' => "storage/$path/$fileName",
                ]);
            }
        }
        return self::successResponse();

    }


    public function show(Document $document, Ruling $ruling)
    {
        return new RulingResource($ruling->load(['files', 'rulingStatus']));
    }


    public function update(RulingRequest $request, Document $document, Ruling $ruling)
    {
        $inputs = $request->all();
        $inputs['judgment_date'] = to_georgian($request->judgment_date);

        $inputs['judgment_text'] = $inputs['judgment_text'] ?? '';

        $ruling->update($inputs);

        if ($request->hasFile('files')){
            foreach ($ruling->files as $file){
                Storage::delete($file->path);
                $file->delete();
            }

            foreach ($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($ruling->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/ruling/$ruling->id";


                Storage::putFileAs($path, $file, $fileName);

                $ruling->files()->create([
                   'mime_type' => $file->extension(),
                   'size' => $file->getSize() / 1024,
                   'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function destroy(Document $document, Ruling $ruling)
    {
        if ($ruling->files){
            foreach ($ruling->files as $file){
                if (Storage::disk('public')->exists($file->path)){
                    Storage::disk('public')->delete($file->path);
                }
                $file->delete();
            }
        }

        $ruling->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'rulingStatus' => RulingStatus::select(['id', 'name'])->get(),
        ]);
    }
}
