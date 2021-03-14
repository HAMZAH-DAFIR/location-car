<?php

namespace App\Http\Controllers;

use App\Http\Requests\ControlStoreRequest;
use App\Http\Requests\ControlUpdateRequest;
use App\Http\Resources\ControlResource;
use App\Models\Control;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $controls = Control::all();
    }

    /**
     * @param \App\Http\Requests\ControlStoreRequest $request
     * @return \App\Http\Resources\ControlResource
     */
    public function store(ControlStoreRequest $request)
    {
        $control = Control::create($request->validated());

        return new ControlResource($control);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Control $control
     * @return \App\Http\Resources\ControlResource
     */
    public function show(Request $request, $id)
    {
        $control = Control::find($id);

        return new ControlResource($control);
    }

    /**
     * @param \App\Http\Requests\ControlUpdateRequest $request
     * @param \App\Models\Control $control
     * @return \App\Http\Resources\ControlResource
     */
    public function update(ControlUpdateRequest $request, $id)
    {
        $control = Control::find($id);

        $control->update($request->validated());

        return new ControlResource($control);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Control $control
     * @return \App\Http\Resources\ControlResource
     */
    public function destroy(Request $request, Control $control)
    {
        $control->delete();

        return new ControlResource($control);
    }
}
