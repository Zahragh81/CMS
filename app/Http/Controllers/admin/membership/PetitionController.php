<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetitionRequest;
use App\Http\Resources\membership\PetitionResource;
use App\Models\membership\Document;
use App\Models\membership\Petition;
use Illuminate\Http\Request;

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


    public function store(PetitionRequest $request, Petition $petition)
    {

    }


    public function show()
    {
    }


    public function update()
    {

    }


    public function destroy()
    {

    }


    public function upsertData()
    {

    }
}
