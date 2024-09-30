<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourtBranchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'city_id' => new CityResource($this->whenLoaded('city')),
            'branch_code' => $this->branch_code,
            'address' => $this->address,
            'phone' => $this->phone,
            'branch_type_id' => new BranchTypeResource($this->whenLoaded('branchType')),
            'status' => $this->status
        ];
    }
}
