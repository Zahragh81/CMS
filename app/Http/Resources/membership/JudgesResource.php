<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\UserResource;
use App\Models\membership\OrganizationalPost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JudgesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'courtBranch' => new CourtBranchResource($this->whenLoaded('courtBranch')),
            'organizational_post' => new OrganizationalPostResource($this->whenLoaded('organizationalPost')),
            'status' => $this->status
        ];
    }
}
