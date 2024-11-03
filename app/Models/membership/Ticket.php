<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Ticket extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketGroup()
    {
        return $this->belongsTo(TicketGroup::class);
    }

    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function actions()
    {
        return $this->hasMany(TicketAction::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }


    // Attribute
    public function getAverageProgressPercentageAttribute()
    {
        return $this->actions()->avg('progress_percentage') ?? 0;
    }

}
