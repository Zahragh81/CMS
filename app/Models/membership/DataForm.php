<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class DataForm extends BaseModel
{
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function unitSelection()
    {
        return $this->belongsTo(UnitSelection::class);
    }

    public function answer()
    {
      return $this->belongsTo(Answer::class);
    }
}
