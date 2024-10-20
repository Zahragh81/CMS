<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\to_jalali;

class MeetingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start_time' => to_jalali($this->start_time),
            'end_time' => to_jalali($this->end_time),
            'location' => $this->location,
            'description' => $this->description,
            'notification' => $this->notification,
            'document' => new DocumentResource($this->whenLoaded('document')),
            'meetingStatus' => new MeetingStatusResource($this->whenLoaded('meetingStatus')),
            'holdingType' => new HoldingTypeResource($this->whenLoaded('holdingType')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'status' => $this->status,
        ];
    }
}
