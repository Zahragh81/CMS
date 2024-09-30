<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class BranchType extends BaseModel
{
    public function courtBranches()
    {
        return $this->hasMany(CourtBranch::class);
    }
}
