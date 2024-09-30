<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Document extends BaseModel
{
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courtBranch()
    {
        return $this->belongsTo(CourtBranch::class);
    }

    public function documentStatus()
    {
        return $this->belongsTo(DocumentStatus::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }

    public function petitions()
    {
        return $this->hasMany(Petition::class);
    }

}
