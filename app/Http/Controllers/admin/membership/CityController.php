<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\membership\CityResource;
use App\Models\membership\City;
use App\Models\membership\Province;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::select(['id', 'name', 'status', 'parent_id'])
            ->with('province')
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })
            ->paginate($this->first);

        return CityResource::collection($cities);
    }


    public function store(CityRequest $request)
    {
       City::create($request->all());

        return self::successResponse();
    }


    public function show(City $city)
    {
        return new CityResource($city->load('province'));
    }


    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());

        return self::successResponse();
    }


    public function destroy(City $city)
    {
        $city->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'provinces' => Province::select(['id', 'name'])->get(),
        ]);
    }

}
