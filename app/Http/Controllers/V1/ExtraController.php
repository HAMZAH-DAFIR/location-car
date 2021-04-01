<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtraStoreRequest;
use App\Http\Requests\ExtraUpdateRequest;
use App\Http\Resources\ExtraResource;
use App\Models\Extra;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $extras = Extra::all();
    }

    /**
     * @param \App\Http\Requests\ExtraStoreRequest $request
     * @return \App\Http\Resources\ExtraResource
     */
    public function store(ExtraStoreRequest $request)
    {
        $extra = Extra::create($request->validated());

        return new ExtraResource($extra);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Extra $extra
     * @return \App\Http\Resources\ExtraResource
     */
    public function show(Request $request, Extra $extra)
    {
        $extra = Extra::find($id);

        return new ExtraResource($extra);
    }

    /**
     * @param \App\Http\Requests\ExtraUpdateRequest $request
     * @param \App\Models\Extra $extra
     * @return \App\Http\Resources\ExtraResource
     */
    public function update(ExtraUpdateRequest $request, Extra $extra)
    {
        $extra = Extra::find($id);

        $extra->update($request->validated());

        return new ExtraResource($extra);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Extra $extra
     * @return \App\Http\Resources\ExtraResource
     */
    public function destroy(Request $request, Extra $extra)
    {
        $extra->delete();

        return new ExtraResource($extra);
    }
}
