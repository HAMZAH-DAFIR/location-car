<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReformationStoreRequest;
use App\Http\Requests\ReformationUpdateRequest;
use App\Http\Resources\ReformationResource;
use App\Models\Reformation;
use Illuminate\Http\Request;

class ReformationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reformations = Reformation::all();
    }

    /**
     * @param \App\Http\Requests\ReformationStoreRequest $request
     * @return \App\Http\Resources\ReformationResource
     */
    public function store(ReformationStoreRequest $request)
    {
        $reformation = Reformation::create($request->validated());

        return new ReformationResource($reformation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reformation $reformation
     * @return \App\Http\Resources\ReformationResource
     */
    public function show(Request $request, Reformation $reformation)
    {
        $reformation = Reformation::find($id);

        return new ReformationResource($reformation);
    }

    /**
     * @param \App\Http\Requests\ReformationUpdateRequest $request
     * @param \App\Models\Reformation $reformation
     * @return \App\Http\Resources\ReformationResource
     */
    public function update(ReformationUpdateRequest $request, Reformation $reformation)
    {
        $reformation = Reformation::find($id);

        $reformation->update($request->validated());

        return new ReformationResource($reformation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reformation $reformation
     * @return \App\Http\Resources\ReformationResource
     */
    public function destroy(Request $request, Reformation $reformation)
    {
        $reformation->delete();

        return new ReformationResource($reformation);
    }
}
