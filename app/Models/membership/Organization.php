<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Organization extends BaseModel
{
    protected $casts = [
        'ticket_actions_count' => 'integer'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Organization::class);
    }

    public function children()
    {
        return $this->hasMany(Organization::class, 'parent_id');
    }

    public function avatar()
    {
        return $this->morphOne(File::class, 'model');
    }

    public function ticketActions()
    {
        return $this->hasMany(TicketAction::class);
    }

}
