<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('permissionGroup')->get();

        return PermissionResource::collection($permissions);
    }


    public function upsertData()
    {
        return self::successResponse([
            'permissionGroup' => PermissionGroup::select(['id', 'name'])->get()
        ]);
    }
}
