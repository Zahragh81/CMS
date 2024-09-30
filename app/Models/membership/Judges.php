<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Judges extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courtBranch()
    {
        return $this->belongsTo(CourtBranch::class);
    }

    public function organizationalPost()
    {
        return $this->belongsTo(OrganizationalPost::class);
    }


}
