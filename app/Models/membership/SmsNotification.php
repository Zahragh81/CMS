<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class SmsNotification extends BaseModel
{
    public function recipient()
    {
        return $this->belongsTo(SmsNotificationRecipient::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}
