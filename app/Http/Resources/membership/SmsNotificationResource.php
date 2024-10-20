<?php

namespace App\Http\Resources\membership;

use App\Models\membership\SmsNotificationRecipient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\to_jalali;

class SmsNotificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
       return [
           'id' => $this->id,
           'text' => $this->text,
           'model_type' => $this->model_type,
           'model_id' => $this->model_id,
           'send_time' => to_jalali($this->send_time),
           'recipient' => new SmsNotificationRecipientResource($this->whenLoaded('recipient')),
           'status' => $this->status,

       ];
    }
}
