<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\to_jalali;

class PetitionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'document' => new DocumentResource($this->whenLoaded('document')),
            'petition_number' => $this->petition_number,
            'petition_date' => to_jalali($this->petition_date),
            'petition_text' => $this->petition_text,
            'files' => FileResource::collection($this->whenLoaded('files')),
            'status' => $this->status
        ];
    }
}
