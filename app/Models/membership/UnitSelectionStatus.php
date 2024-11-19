<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class UnitSelectionStatus extends BaseModel
{
    public function unitSelections()
    {
        return $this->hasMany(UnitSelection::class);
    }
}
