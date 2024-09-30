<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationalPostRequest;
use App\Http\Resources\membership\OrganizationalPostResource;
use App\Models\membership\OrganizationalPost;

class OrganizationalPostController extends Controller
{
    public function index()
    {
        $organizationalPosts = OrganizationalPost::select(['id', 'name', 'status'])
            ->where(function ($q){
                $q->where('name', 'like', $this->search);
            })
            ->paginate($this->first);

        return OrganizationalPostResource::collection($organizationalPosts);
    }


    public function store(OrganizationalPostRequest $request)
    {
        OrganizationalPost::create($request->all());

        return self::successResponse();
    }


    public function show(OrganizationalPost $organizationalPost)
    {
        return new OrganizationalPostResource($organizationalPost);
    }


    public function update(OrganizationalPostRequest $request, OrganizationalPost $organizationalPost)
    {
        $organizationalPost->update($request->all());

        return self::successResponse();
    }


    public function destroy(OrganizationalPost $organizationalPost)
    {
        $organizationalPost->delete();

        return self::successResponse();
    }
}
