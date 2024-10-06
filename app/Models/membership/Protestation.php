<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Protestation extends BaseModel
{
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function protestationStatus()
    {
        return $this->belongsTo(ProtestationStatus::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
