<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => new UserResource($this->whenLoaded('user')),
            'ticketGroup' => new TicketGroupResource($this->whenLoaded('ticketGroup')),
            'ticketPriority' => new TicketPriorityResource($this->whenLoaded('ticketPriority')),
            'ticketStatus' => new TicketStatusResource($this->whenLoaded('ticketStatus')),
            'files' => FileResource::collection($this->whenLoaded('files')),
//            'average_progress_percentage' => $this->whenAggregated('actions', 'progress_percentage', 'avg'),
            'average_progress_percentage' => $this->average_progress_percentage,
            'status' =>  $this->status,
        ];
    }
}
