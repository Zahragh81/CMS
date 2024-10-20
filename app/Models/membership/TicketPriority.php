<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class TicketPriority extends BaseModel
{
    public function tikets()
    {
        return $this->hasMany(Ticket::class);
    }
}
