<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Gender;
use App\Models\Organization;
use App\Models\PermissionGroup;
use App\Models\RoleGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users->load('gender', 'organization'));
    }

//paginate
//    public function index(Request $request)
//    {
//        $perPage = $request->input('per_page', 10);
//        $users = User::with('gender', 'organization')->paginate($perPage);
//
//        return UserResource::collection($users);
//    }


    public function show(User $user)
    {
        return new UserResource($user->load('gender', 'organization'));
    }


    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $file = $request->file('file');

            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($user->created_at)->format('Y/m/d');
            $path = "$basePath/user/$user->id";

            Storage::putFileAs($path, $file, $fileName);

            $user->avatar()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName"
            ]);
        }

        return self::successResponse();
    }


    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        if ($request->hasFile('file')) {
            $existingAvatar = $user->avatar;

            if ($existingAvatar) {
                Storage::disk('public')->delete($existingAvatar->path);
                $existingAvatar->delete();
            }

            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($user->created_at)->format('Y/m/d');
            $path = "$basePath/user/$user->id";

            Storage::putFileAs($path, $file, $fileName);

            $user->avatar()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName"
            ]);
        }

        return self::successResponse();
    }


    public function destroy(User $user)
    {
        if ($user->avatar) {
            $filePath = $user->avatar->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $user->avatar()->delete();
        }

        $user->delete();

        return self::successResponse();
    }


    public function upsertData(Request $request)
    {
        return self::successResponse([
            'genders' => Gender::select(['id', 'name'])->get(),
            'organizations' => Organization::select(['id', 'name'])->get(),
        ]);
    }
}
