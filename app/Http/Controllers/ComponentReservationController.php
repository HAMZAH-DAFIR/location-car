<?php

namespace App\Http\Controllers;

use App\ComponentReservation;
use App\Http\Requests\ComponentReservationStoreRequest;
use App\Http\Requests\ComponentReservationUpdateRequest;
use App\Http\Resources\ComponentReservationResource;
use App\componentReservation;
use Illuminate\Http\Request;

class ComponentReservationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $componentReservations = ComponentReservation::all();
    }

    /**
     * @param \App\Http\Requests\ComponentReservationStoreRequest $request
     * @return \App\Http\Resources\ComponentReservationResource
     */
    public function store(ComponentReservationStoreRequest $request)
    {
        $componentReservation = ComponentReservation::create($request->validated());

        return new ComponentReservationResource($component-reservation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\componentReservation $componentReservation
     * @return \App\Http\Resources\ComponentReservationResource
     */
    public function show(Request $request, ComponentReservation $componentReservation)
    {
        $componentReservation = ComponentReservation::find($id);

        return new ComponentReservationResource($component-reservation);
    }

    /**
     * @param \App\Http\Requests\ComponentReservationUpdateRequest $request
     * @param \App\componentReservation $componentReservation
     * @return \App\Http\Resources\ComponentReservationResource
     */
    public function update(ComponentReservationUpdateRequest $request, ComponentReservation $componentReservation)
    {
        $componentReservation = ComponentReservation::find($id);

        $componentReservation->update($request->validated());

        return new ComponentReservationResource($component-reservation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\componentReservation $componentReservation
     * @return \App\Http\Resources\ComponentReservationResource
     */
    public function destroy(Request $request, ComponentReservation $componentReservation)
    {
        $componentReservation->delete();

        return new ComponentReservationResource($component-reservation);
    }
}
