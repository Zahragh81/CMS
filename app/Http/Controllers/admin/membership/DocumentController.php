<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\DocumentRequest;
use App\Http\Resources\membership\DocumentResource;
use App\Models\membership\BranchType;
use App\Models\membership\CourtBranch;
use App\Models\membership\Document;
use App\Models\membership\DocumentStatus;
use App\Models\membership\DocumentType;
use App\Models\membership\Lawyer;
use App\Models\membership\Situation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())
            ->where('document_status_id', 1)
        ->select(['id', 'file_number', 'document_type_id', 'lawyer_id','plaintiff_id', 'court_branch_id', 'court_class_number', 'court_filing_number', /*'document_status_id',*/ 'description', 'status'])
            ->with([
                'documentType:id,name',
                'lawyer' => fn ($q) => $q->select(['id', 'office_name', 'user_id'])->with([
                    'user:id,username,first_name,last_name'
                ]),
                'plaintiff:id,username,first_name,last_name',
                'courtBranch:id,name,branch_code',
                'files'
            ])
            ->where(fn ($q) => $q->where('file_number', 'like', $this->search))
            ->paginate($this->first);

        return DocumentResource::collection($documents);
    }


    public function closedIndex()
    {
        $documents = Document::where('user_id', Auth::id())
            ->where('document_status_id', 2)
            ->select(['id', 'file_number', 'document_type_id', 'lawyer_id','plaintiff_id', 'court_branch_id', 'court_class_number', 'court_filing_number', /*'document_status_id',*/ 'description', 'status'])
            ->with([
                'documentType:id,name',
                'lawyer' => fn ($q) => $q->select(['id', 'office_name', 'user_id'])->with([
                    'user:id,username,first_name,last_name'
                ]),
                'plaintiff:id,username,first_name,last_name',
                'courtBranch:id,name,branch_code',
                'files'
            ])
            ->where(fn ($q) => $q->where('file_number', 'like', $this->search))
            ->paginate($this->first);

        return DocumentResource::collection($documents);
    }


    public function stagnantIndex()
    {
        $documents = Document::where('user_id', Auth::id())
            ->where('document_status_id', 3)
            ->select(['id', 'file_number', 'document_type_id', 'lawyer_id','plaintiff_id', 'court_branch_id', 'court_class_number', 'court_filing_number', /*'document_status_id',*/ 'description', 'status'])
            ->with([
                'documentType:id,name',

                'lawyer' => fn ($q) => $q->select(['id', 'office_name', 'user_id'])->with([
                    'user:id,username,first_name,last_name'
                ]),
                'plaintiff:id,username,first_name,last_name',
                'courtBranch:id,name,branch_code',
                'files'
            ])
            ->where(fn ($q) => $q->where('file_number', 'like', $this->search))
            ->paginate($this->first);

        return DocumentResource::collection($documents);
    }


    public function store(DocumentRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $document = Document::create($input);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($document->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id";

                Storage::putFileAs($path, $file, $fileName);

                $document->files()->create([
                    'mime_type' => $file->extension(),
                    'size' => $file->getSize() / 1024,
                    'path' => "storage/$path/$fileName",
                ]);
            }
        }
        return self::successResponse();
    }



    public function show(Document $document)
    {
        return new DocumentResource($document->load([
            'documentType:id,name',
            'lawyer' => fn ($q) => $q->select(['id', 'office_name', 'user_id'])->with([
                'user:id,username,first_name,last_name'
            ]),
            'plaintiff:id,username,first_name,last_name',
            'courtBranch:id,name,branch_code',
            'documentStatus:id,name',
            'files'
        ]));
    }


    public function update(DocumentRequest $request, Document $document)
    {
        $document->update($request->all());

        if($request->hasFile('files')){
            $existingFiles = $document->files;

            foreach ($existingFiles as $existingFile){
                Storage::disk('public')->delete($existingFile->path);
                $existingFile->delete();
            }

            foreach ($request->file('files') as $file){
                $fileName = uniqid() . '.' . $file->extension();
                $basePath = jdate($document->created_at)->format('Y/m/d');
                $path = "$basePath/document/$document->id";

                Storage::putFileAs($path, $file, $fileName);

                $document->files()->create([
                   'mime_type' => $file->extension(),
                   'size' => $file->getSize() / 1024,
                   'path' => "storage/$path/$fileName"
                ]);
            }
        }

        return self::successResponse();
    }


    public function destroy(Document $document)
    {
        if($document->files){
            foreach ($document->files as $file){

            if(Storage::disk('public')->exists($file->path)){
                Storage::disk('public')->delete($file->path);
            }

            $file->delete();
            }
        }

        $document->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
//        $currentUser = Auth::user();

        return self::successResponse([
            'documentTypes' => DocumentType::select(['id', 'name'])->get(),
            'lawyers' => Lawyer::with('user:id,username,first_name,last_name')->select(['id', 'office_name', 'user_id'])->get(),
            'plaintiffs' => User::select(['id', 'username', 'first_name', 'last_name'])->get(),
            'courtBranch' => CourtBranch::select(['id', 'name', 'branch_code'])->get(),
//            'documentStatuses' => DocumentStatus::select(['id', 'name'])->get(),
//            'currentUser' => [
//                'id' => $currentUser->id,
//                'username' => $currentUser->username,
//                'first_name' => $currentUser->first_name,
//                'last_name' => $currentUser->last_name,
//            ]
        ]);
    }


    public function changeStatus(ChangeStatusRequest $request, Document $document)
    {
        $newStatus = $request->document_status_id;

        $document->document_status_id = $newStatus;
        $document->save();
        return self::successResponse();
    }


}
