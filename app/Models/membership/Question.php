<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Question extends BaseModel
{
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}


