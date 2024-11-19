<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends BaseModel
{
    public function lessonsOffered(): HasMany
    {
        return $this->hasMany(LessonOffered::class);
    }
}
