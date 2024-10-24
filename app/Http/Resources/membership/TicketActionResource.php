<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketActionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'referral_order' => $this->referral_order,
            'description_action' => $this->description_action,
            'progress_percentage' => $this->progress_percentage,
            'referralType' => new ReferralTypeResource($this->whenLoaded('referralType')),
//            'referrer' => new UserResource($this->whenLoaded('referrer')),
            'organization' => new OrganizationResource($this->whenLoaded('organization')),
            'referralRecipient' => new UserResource($this->whenLoaded('referralRecipient')),
            'actionStatus' => new TicketStatusResource($this->whenLoaded('actionStatus')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'ticket' => new TicketActionResource($this->whenLoaded('ticket')),
            'status' => $this->status,
        ];
    }
}
