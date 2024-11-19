<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Master extends BaseModel
{
    public function lessonsOffered()
    {
        return $this->belongsTo(LessonOffered::class);
    }
}
