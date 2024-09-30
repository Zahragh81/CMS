<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\membership\OrganizationResource;
use App\Models\membership\Organization;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::select(['id', 'name', 'national_id', 'status', 'parent_id'])
            ->with(['parent', 'avatar'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search)->orWhere('national_id', 'like', $this->search);
            })
            ->paginate($this->first);

        return OrganizationResource::collection($organizations);
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


    public function show(Organization $organization)
    {
        return new OrganizationResource($organization->load('parent'));
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

