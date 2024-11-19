<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Form extends BaseModel
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
