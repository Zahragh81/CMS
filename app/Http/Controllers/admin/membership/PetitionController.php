<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\PetitionRequest;
use App\Http\Resources\membership\PetitionResource;
use App\Models\membership\Document;
use App\Models\membership\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;

use function App\Helpers\to_georgian;

class PetitionController extends Controller
{
    public function index(Document $document)
    {
        $petitions = $document->petitions()
            ->select(['id', 'document_id', 'petition_number', 'petition_date', 'petition_text', 'status'])
            ->with(['files'])
            ->where('petition_number', 'like', $this->search)
            ->paginate($this->first);

        return PetitionResource::collection($petitions);
    }


    public function store(PetitionRequest $request, Document $document)
    {
        $inputs = $request->all();
        $inputs['petition_date'] = to_georgian($request->petition_date);
        $inputs['petition_text'] = $inputs['petition_text'] ?? '';

        $petition = $document->petitions()->create($inputs);

        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($petition->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/petition/$petition->id";

                Storage::putFileAs($path, $file, $fileName);

                $petition->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName",
                ]);
            }
        }
        return self::successResponse();
    }


    public function show(Document $document, Petition $petition)
    {
        return new PetitionResource($petition->load('files'));
    }


    public function update(PetitionRequest $request, Document $document, Petition $petition)
    {
        $input = $request->all();
        $input['petition_date'] = to_georgian($request->petition_date);
        $input['petition_text'] = $input['petition_text'] ?? '';

        $petition->update($input);

        if ($request->hasFile('files')){
            foreach ($petition->files as $file){
                Storage::delete($file->path);
                $file->delete();
            }

            foreach ($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($petition->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id/petition/$petition->id";

                Storage::putFileAs($path, $file, $fileName);

                $petition->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function destroy(Document $document, Petition $petition)
    {
        if ($petition->files) {
            foreach ($petition->files as $file){
                if (Storage::disk('public')->exists($file->path)){
                    Storage::disk('public')->delete($file->path);
                }
                $file->delete();
            }
        }
        $petition->delete();

        return self::successResponse();
    }


}
