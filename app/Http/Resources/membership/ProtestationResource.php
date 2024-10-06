<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\to_jalali;

class ProtestationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'protestation_number' => $this->protestation_number,
            'protestation_date' => to_jalali($this->protestation_date),
            'protestation_text' => $this->protestation_text,
            'document' => new DocumentResource($this->whenLoaded('document')),
            'protestationStatus' => new ProtestationStatusResource($this->whenLoaded('protestationStatus')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'status' => $this->status,
        ];
    }
}
