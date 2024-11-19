<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataFormResource extends JsonResource
{
    public function toArray(Request $request): array
    {
       return [
           'id' => $this->id,
           'form' => new  FormResource($this->whenLoaded('form')),
           'question' => new QuestionResource($this->whenLoaded('question')),
           'unitSelection' => new UnitSelectionResource($this->whenLoaded('unitSelection')),
           'answer' => new AnswerResource($this->whenLoaded('answer')),
           'status' => $this->status,
       ];
    }
}
