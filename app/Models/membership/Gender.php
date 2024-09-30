<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Gender extends BaseModel
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
