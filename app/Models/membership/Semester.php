<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Semester extends BaseModel
{
    public function lessonsOffered()
    {
        return $this->hasMany(LessonOffered::class);
    }
}
