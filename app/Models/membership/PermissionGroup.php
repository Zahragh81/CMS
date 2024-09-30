<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class PermissionGroup extends BaseModel
{
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
