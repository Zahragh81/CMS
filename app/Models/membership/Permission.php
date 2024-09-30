<?php

namespace App\Models\membership;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $guard_name = 'api';

    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
