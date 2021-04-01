<?php

namespace App\Http\Controllers;

use App\Http\Requests\DamageStoreRequest;
use App\Http\Requests\DamageUpdateRequest;
use App\Http\Resources\DamageResource;
use App\Models\Damage;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $damages = Damage::all();
    }

    /**
     * @param \App\Http\Requests\DamageStoreRequest $request
     * @return \App\Http\Resources\DamageResource
     */
    public function store(DamageStoreRequest $request)
    {
        $damage = Damage::create($request->validated());

        return new DamageResource($damage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Damage $damage
     * @return \App\Http\Resources\DamageResource
     */
    public function show(Request $request, $id)
    {
        $damage = Damage::find($id);

        return new DamageResource($damage);
    }

    /**
     * @param \App\Http\Requests\DamageUpdateRequest $request
     * @param \App\Models\Damage $damage
     * @return \App\Http\Resources\DamageResource
     */
    public function update(DamageUpdateRequest $request,$id)
    {
        $damage = Damage::find($id);

        $damage->update($request->validated());

        return new DamageResource($damage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Damage $damage
     * @return \App\Http\Resources\DamageResource
     */
    public function destroy(Request $request, Damage $damage)
    {
        $damage->delete();

        return new DamageResource($damage);
    }
}
