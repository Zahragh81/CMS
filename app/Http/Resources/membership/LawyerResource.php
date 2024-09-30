<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LawyerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'office_name' => $this->office_name,
            'office_address' => $this->office_address,
            'office_phone' => $this->office_phone,
            'degree' => new DegreeResource($this->whenLoaded('degree')),
            'status' => $this->status
        ];
    }
}
