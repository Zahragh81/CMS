<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonOfferedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lesson' => new LessonResource($this->whenLoaded('lesson')),
            'semester' => new SemesterResource($this->whenLoaded('semester')),
            'master' => new MasterResource($this->whenLoaded('master')),
            'status' => $this->status,
        ];
    }
}
