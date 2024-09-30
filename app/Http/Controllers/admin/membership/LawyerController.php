<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\LawyerRequest;
use App\Http\Resources\membership\LawyerResource;
use App\Models\membership\Degree;
use App\Models\membership\Lawyer;
use App\Models\User;
use Illuminate\Http\Request;
use function App\Helpers\user_search;

class LawyerController extends Controller
{
    public function index()
    {
        $lawyers = Lawyer::select(['id', 'user_id', 'office_name', 'office_address', 'office_phone', 'degree_id', 'status'])
            ->with([
                'user:id,username,first_name,last_name',
                'degree:id,name'
            ])
            ->whereHas('user', fn ($q) => user_search($q, $this->search))
            ->orWhereHas('degree', fn ($q) => $q->where('name', 'like', $this->search))
            ->paginate($this->first);

        return LawyerResource::collection($lawyers);
    }


    public function store(LawyerRequest $request)
    {
        Lawyer::create($request->all());

        return self::successResponse();
    }


    public function show(Lawyer $lawyer)
    {
        return new LawyerResource($lawyer->load([
            'user:id,username,first_name,last_name',
            'degree:id,name'
        ]));
    }


    public function update(LawyerRequest $request, Lawyer $lawyer)
    {
        $lawyer->update($request->all());

        return self::successResponse();
    }


    public function destroy(Lawyer $lawyer)
    {
        $lawyer->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'users' => User::select(['id', 'username', 'first_name', 'last_name'])->get(),
            'degrees' => Degree::select(['id', 'name'])->get()
        ]);
    }
}
