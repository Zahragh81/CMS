<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class Province extends BaseModel
{
    protected $table = 'cities';

    protected static function booted(): void
    {
        static::addGlobalScope('province', fn (Builder $builder) => $builder->whereNull('parent_id'));
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
