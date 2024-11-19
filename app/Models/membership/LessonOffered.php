<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class LessonOffered extends BaseModel
{
    protected $table = 'lessons_offered';

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function unitSelections()
    {
        return $this->hasMany(UnitSelection::class);
    }

}
