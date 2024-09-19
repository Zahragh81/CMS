<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends BaseModel
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
