<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::firstWhere('username', $request->username);


        if (!$user || !Hash::check($request->password, $user->password))
            return self::successResponse('اطلاعات وارد شده معتبر نیست');

        $token = $user->createToken('api')->plainTextToken;

        return self::successResponse([
            'user' => $user,
            'token' => $token
        ]);
    }


//با role, permissions
//    public function login(LoginRequest $request)
//    {
//        $user = User::firstWhere('username', $request->username);
//
//        if (!$user || !Hash::check($request->password, $user->password))
//            return self::errorResponse('اطلاعات وارد شده معتبر نیست.');
//
//        $token = $user->createToken('api')->plainTextToken;
//
//        $permissions = Permission::whereHas('roles', function ($role) use ($user) {
//            $role->whereIn('id', $user->roles()->pluck('id'));
//        })->pluck('name');
//
//        return self::successResponse([
//            'user' => new UserResource($user->load(['gender', 'organization', 'roles'])),
//            'token' => $token,
//            'permissions' => $permissions
//        ]);
//    }



    public function logout()
    {
        Auth::user()->tokens()->delete();

        return self::successResponse();
    }
}
