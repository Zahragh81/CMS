<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourtBranchRequest;
use App\Http\Resources\membership\CourtBranchResource;
use App\Models\membership\City;
use App\Models\membership\CourtBranch;
use App\Models\membership\BranchType;
use Illuminate\Http\Request;

class CourtBranchController extends Controller
{
    public function index()
    {
        $courtBranches = CourtBranch::select(['id', 'name', 'city_id', 'branch_code', 'address', 'phone', 'branch_type_id', 'status'])
            ->with(['city', 'branchType'])
            ->where(function ($q){
                $q->where('name', 'like', $this->search)->orWhere('branch_code', 'like', $this->search);
            })
            ->paginate($this->first);

        return CourtBranchResource::collection($courtBranches);
    }


    public function store(CourtBranchRequest $request)
    {
        CourtBranch::create($request->all());

        return self::successResponse();
    }


    public function show(CourtBranch $courtBranch)
    {
        return new CourtBranchResource($courtBranch->load(['city', 'branchType']));
    }


    public function update(CourtBranchRequest $request, CourtBranch $courtBranch)
    {
        $courtBranch->update($request->all());

        return self::successResponse();
    }


    public function destroy(CourtBranch $courtBranch)
    {
        $courtBranch->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'cities' => City::select(['id', 'name'])->get(),
            'branchTypes' => BranchType::select(['id', 'name'])->get()
        ]);

    }
}
