<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\membership\Gender;
use App\Models\membership\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use function App\Helpers\user_search;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select(['id', 'username', 'first_name', 'last_name', 'mobile', 'status', 'gender_id', 'organization_id'])
            ->with([
                'gender:id,name',
                'organization:id,name'
            ])
            ->where(fn ($q) => user_search($q, $this->search))
            ->paginate($this->first);

        return UserResource::collection($users);
    }


    public function store(UserRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = $request->username;

        $user = User::create($inputs);

        if ($request->hasFile('file')) {
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


    public function show(User $user)
    {
        return new UserResource($user->load([
            'gender:id,name',
            'organization:id,name'
        ]));
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


    public function upsertData()
    {
        return self::successResponse([
            'genders' => Gender::select(['id', 'name'])->get(),
            'organizations' => Organization::select(['id', 'name'])->get(),
        ]);
    }
}
