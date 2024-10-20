<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class TicketStatus extends BaseModel
{
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
