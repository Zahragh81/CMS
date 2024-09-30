<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class City extends BaseModel
{
    protected static function booted(): void
    {
        static::addGlobalScope('province', fn (Builder $builder) => $builder->whereNotNull('parent_id'));
    }

    public function province()
    {
       return $this->belongsTo(Province::class, 'parent_id');
    }

    public function courtBranches()
    {
        return $this->hasMany(CourtBranch::class);
    }
}
