<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Answer extends BaseModel
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
