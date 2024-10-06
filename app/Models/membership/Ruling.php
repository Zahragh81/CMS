<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Ruling extends BaseModel
{
    public function document()
    {
        return $this->belongsTo(Document::class);
    }


    public function rulingStatus()
    {
     return $this->belongsTo(RulingStatus::class);
    }


    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
