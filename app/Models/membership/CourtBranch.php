<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class CourtBranch extends BaseModel
{
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function branchType()
    {
        return $this->belongsTo(BranchType::class);
    }
}
