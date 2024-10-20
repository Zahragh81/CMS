<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Meeting extends BaseModel
{
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function meetingStatus()
    {
        return $this->belongsTo(MeetingStatus::class);
    }

    public function holdingType()
    {
        return $this->belongsTo(HoldingType::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }

    public function recipients()
    {
        return $this->hasMany(SmsNotificationRecipient::class);
    }

    public function notifications()
    {
        return $this->hasMany(SmsNotification::class);
    }
}
