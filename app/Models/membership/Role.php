<?php

namespace App\Models\membership;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $guard_name = 'api';

    public function roleGroup()
    {
        return $this->belongsTo(RoleGroup::class);
    }
}
