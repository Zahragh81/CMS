<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Lawyer extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
