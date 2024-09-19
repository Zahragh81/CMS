<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function organizations(OrganizationRequest $request)
    {
        $organizations = Organization::select(['id', 'name'])
            ->where('name' , 'like', "%$request->search%")
            ->limit(10)
            ->get();

       return OrganizationResource::collection($organizations);
    }
}
