<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\RoleGroup;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('roleGroup')->get();

        return RoleResource::collection($roles);
    }


    public function show(Role $role)
    {
        return new RoleResource($role->load('roleGroup'));
    }

    public function store(RoleRequest $request)
    {
        $permission_ids = array_map(function ($permission_id) {
            return +$permission_id;
        }, $request->permissions ?? []);

        $inputs = $request->all();
        $inputs['role_group_id'] = 1;

        $role = Role::create($inputs);

        $role->syncPermissions($permission_ids);

        return self::successResponse();
    }


    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());

        $permission_ids = array_map(fn($permission_id) => (int) $permission_id, $request->permissions ?? []);

        $role->syncPermissions($permission_ids);

        return self::successResponse();
    }

//    public function destroy(Role $role)
//    {
//        $role->delete();
//
//        return self::successResponse();
//    }


    public function upsertData()
    {
        return self::successResponse([
            'permissionGroup' => PermissionGroup::select(['id', 'name'])->get(),
            'permissions' => Permission::select(['id', 'name'])->get()
        ]);
    }
}
