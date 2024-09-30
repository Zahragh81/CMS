<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\membership\Permission;
use App\Models\membership\PermissionGroup;
use App\Models\membership\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::select(['id', 'name', 'title', 'role_group_id'])
            ->with('roleGroup:id,name')
            ->where(function ($q){
                $q->where('name', 'like', $this->search)
                    ->orWhere('title', 'like', $this->search);
            })->paginate($this->first);

        return RoleResource::collection($roles);
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


    public function show(Role $role)
    {
        return new RoleResource($role->load('roleGroup'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());

        $permission_ids = array_map(fn($permission_id) => (int)$permission_id, $request->permissions ?? []);

        $role->syncPermissions($permission_ids);

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'permissionGroup' => PermissionGroup::select(['id', 'name'])->get(),
            'permissions' => Permission::select(['id', 'name'])->get()
        ]);
    }
}
