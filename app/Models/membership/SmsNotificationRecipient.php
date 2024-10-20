<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class SmsNotificationRecipient extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
