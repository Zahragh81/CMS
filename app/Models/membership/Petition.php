<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Petition extends BaseModel
{
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
