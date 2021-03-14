<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeStoreRequest;
use App\Http\Requests\EmployeUpdateRequest;
use App\Http\Resources\EmployeResource;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employes = Employe::all();
    }

    /**
     * @param \App\Http\Requests\EmployeStoreRequest $request
     * @return \App\Http\Resources\EmployeResource
     */
    public function store(EmployeStoreRequest $request)
    {
        $employe = Employe::create($request->validated());

        return new EmployeResource($employe);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \App\Http\Resources\EmployeResource
     */
    public function show(Request $request,$id)
    {
        $employe = Employe::find($id);

        return new EmployeResource($employe);
    }

    /**
     * @param \App\Http\Requests\EmployeUpdateRequest $request
     * @param \App\Models\Employe $employe
     * @return \App\Http\Resources\EmployeResource
     */
    public function update(EmployeUpdateRequest $request,$id)
    {
        $employe = Employe::find($id);

        $employe->update($request->validated());

        return new EmployeResource($employe);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employe $employe
     * @return \App\Http\Resources\EmployeResource
     */
    public function destroy(Request $request, Employe $employe)
    {
        $employe->delete();

        return new EmployeResource($employe);
    }
}
