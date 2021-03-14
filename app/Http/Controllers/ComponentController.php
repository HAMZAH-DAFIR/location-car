<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentStoreRequest;
use App\Http\Requests\ComponentUpdateRequest;
use App\Http\Resources\ComponentResource;
use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $components = Component::all();
    }

    /**
     * @param \App\Http\Requests\ComponentStoreRequest $request
     * @return \App\Http\Resources\ComponentResource
     */
    public function store(ComponentStoreRequest $request)
    {
        $component = Component::create($request->validated());

        return new ComponentResource($component);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Component $component
     * @return \App\Http\Resources\ComponentResource
     */
    public function show(Request $request, Component $component)
    {
        $component = Component::find($id);

        return new ComponentResource($component);
    }

    /**
     * @param \App\Http\Requests\ComponentUpdateRequest $request
     * @param \App\Models\Component $component
     * @return \App\Http\Resources\ComponentResource
     */
    public function update(ComponentUpdateRequest $request, Component $component)
    {
        $component = Component::find($id);

        $component->update($request->validated());

        return new ComponentResource($component);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Component $component
     * @return \App\Http\Resources\ComponentResource
     */
    public function destroy(Request $request, Component $component)
    {
        $component->delete();

        return new ComponentResource($component);
    }
}
