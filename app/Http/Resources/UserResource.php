<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'avatar' => $this->avatar ? $this->avatar->path : null,

            'gender' => new GenderResource($this->whenLoaded('gender')),
            'organization' => new OrganizationResource($this->whenLoaded('organization')),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
