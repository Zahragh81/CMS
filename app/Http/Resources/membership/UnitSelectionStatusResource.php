<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitSelectionStatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'status' => $this->status
        ];
    }
}