<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'national_id' => $this->national_id,
            'status' => $this->status,
            'avatar' => $this->avatar ? asset($this->avatar->path) : null,

            'parent' => new OrganizationResource($this->whenLoaded('parent')),
        ];
    }
}


