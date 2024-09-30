<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\membership\Permission;

class PermissionController extends Controller
{
    public function index()
    {
       $permissions = Permission::select(['id', 'name', 'title', 'permission_group_id'])
           ->with('permissionGroup:id,name')
           ->where(function ($q){
               $q->where('name', 'like', $this->search)->orWhere('title', 'like', $this->search);
           })->paginate($this->first);

       return PermissionResource::collection($permissions);
    }
}
