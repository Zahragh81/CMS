<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class TicketGroup extends BaseModel
{
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
