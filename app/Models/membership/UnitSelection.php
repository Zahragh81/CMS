<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class UnitSelection extends BaseModel
{
    public function lessonOffered()
    {
        return $this->belongsTo(LessonOffered::class);
    }

    public function unitSelectionStatus()
    {
        return $this->belongsTo(UnitSelectionStatus::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function dataForms()
    {
        return $this->hasMany(DataForm::class);
    }

}
