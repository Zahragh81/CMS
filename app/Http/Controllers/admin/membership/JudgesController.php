<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\JudgesRequest;
use App\Http\Resources\membership\JudgesResource;
use App\Models\membership\BranchType;
use App\Models\membership\CourtBranch;
use App\Models\membership\Judges;
use App\Models\membership\OrganizationalPost;
use App\Models\User;
use Illuminate\Http\Request;

class JudgesController extends Controller
{
    public function index()
    {
        $judges = Judges::select(['id', 'user_id', 'court_branch_id', 'organizational_post_id', 'status'])
            ->with([
                'user:id,username,first_name,last_name,status',
                'courtBranch:id,name,branch_code',
                'organizationalPost'
            ])
            ->whereHas('user', function ($q) {
                $q->where('last_name', 'like', $this->search);
            })
            ->orWhereHas('courtBranch', function ($q) {
                $q->where('name', 'like', $this->search);
            })
            ->paginate($this->first);

        return JudgesResource::collection($judges);
    }



    public function store(JudgesRequest $request)
    {
        Judges::create($request->all());

        return self::successResponse();
    }


    public function show(Judges $judges)
    {
        return new JudgesResource($judges->load([
            'user:id,username,first_name,last_name',
            'courtBranch:id,name,branch_code',
            'organizationalPost'
        ]));
    }


    public function update(JudgesRequest $request, Judges $judges)
    {
        $judges->update($request->all());

        return self::successResponse();
    }


    public function destroy(Judges $judges)
    {
        $judges->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'users' => User::select(['id', 'username', 'first_name', 'last_name'])->get(),
            'organizationalPost' => OrganizationalPost::select(['id', 'name'])->get(),
            'courtBranches' => CourtBranch::select(['id', 'name'])->get(),
        ]);
    }
}
