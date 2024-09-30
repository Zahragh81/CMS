<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class File extends BaseModel
{
    public function model()
    {
        return $this->morphTo();
    }

}
