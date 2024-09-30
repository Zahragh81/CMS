<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Resources\membership\OrganizationResource;
use App\Models\membership\Organization;

class SelectController extends Controller
{
    public function organization()
    {
        $organizations = Organization::select(['id', 'name'])
            ->where('name' , 'like', $this->search)
            ->whereNotNull('parent_id')
            ->limit(10)
            ->get();

       return OrganizationResource::collection($organizations);
    }
}
