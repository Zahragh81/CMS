<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitSelectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'score' => $this->score,
            'lessonOffered' => new LessonOfferedResource($this->whenLoaded('lessonOffered')),
            'student' => new UserResource($this->whenLoaded('student')),
            'unitSelectionStatus' => new UnitSelectionStatusResource($this->whenLoaded('unitSelectionStatus')),
            'status' => $this->status
        ];
    }
}
