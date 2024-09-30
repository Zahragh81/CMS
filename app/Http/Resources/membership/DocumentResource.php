<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return array(
            'id' => $this->id,
            'file_number' => $this->file_number,
            'documentType' => new DocumentTypeResource($this->whenLoaded('documentType')),
            'lawyer' => new LawyerResource($this->whenLoaded('lawyer')),
            'user' => new UserResource($this->whenLoaded('user')),
            'courtBranch' => new CourtBranchResource($this->whenLoaded('courtBranch')),
            'court_class_number' => $this->court_class_number,
            'court_filing_number' => $this->court_filing_number,
            'documentStatus' => new DocumentStatusResource($this->whenLoaded('documentStatus')),
            'description' => $this->description,
            'files' => FileResource::collection($this->whenLoaded('files')),
            'status' => $this->status,
        );
    }
}
