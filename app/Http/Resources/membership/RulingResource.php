<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\to_jalali;

class RulingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judgment_number' => $this->judgment_number,
            'judgment_date' => to_jalali($this->judgment_date),
            'judgment_text' => $this->judgment_text,
            'document' => new DocumentResource($this->whenLoaded('document')),
            'rulingStatus' => new RulingStatusResource($this->whenLoaded('rulingStatus')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'status' => $this->status,
        ];
    }
}
