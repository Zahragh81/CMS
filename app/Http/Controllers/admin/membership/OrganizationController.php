<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();

        return OrganizationResource::collection($organizations->load('parent'));
    }

    //paginate
//    public function index(Request $request)
//    {
//        $perPage = $request->input('per_page', 10);
//        $organizations = Organization::with('parent')->paginate($perPage);
//
//        return OrganizationResource::collection($organizations);
//    }


    public function show(Organization $organization)
    {
        return new OrganizationResource($organization->load('parent'));
    }


    public function store(OrganizationRequest $request)
    {
        $organization = Organization::create($request->all());

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($organization->created_at)->format('Y/m/d');
            $path = "$basePath/organization/$organization->id";

            Storage::putFileAs($path, $file, $fileName);

            $organization->avatar()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
            ]);
        }

        return self::successResponse();
    }


    public function update(OrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->all());

        if ($request->hasFile('file')) {
            $existingAvatar = $organization->avatar;

            if ($existingAvatar) {
                Storage::disk('public')->delete($existingAvatar->path);
                $existingAvatar->delete();
            }

            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->extension();
            $basePath = jdate($organization->created_at)->format('Y/m/d');
            $path = "$basePath/organization/$organization->id";

            Storage::putFileAs($path, $file, $fileName);

            $organization->avatar()->create([
                'mime_type' => $file->extension(),
                'size' => $file->getSize() / 1024,
                'path' => "storage/$path/$fileName",
            ]);
        }

        return self::successResponse();
    }



    public function destroy(Organization $organization)
    {
        if ($organization->avatar) {
            $filePath = $organization->avatar->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $organization->avatar()->delete();
        }

        $organization->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'organizations' => Organization::select(['id', 'name'])->get(),

        ]);
    }
}

