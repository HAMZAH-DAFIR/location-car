<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Extrareservation;
use App\Http\Resources\ExtraReservationResource;
use App\Http\Requests\ExtraReservationsStoreRequest;
use App\Http\Requests\ExtraReservationsUpdateRequest;

class ExtraReservationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $extraReservations = Extrareservation::all();
    }

    /**
     * @param \App\Http\Requests\ExtraReservationsStoreRequest $request
     * @return \App\Http\Resources\ExtraReservationResource
     */
    public function store(Request $request)
    {
        $extraReservation = ExtraReservation::create($request->validated());

        return response()->json($extraReservation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\extraReservation $extraReservation
     * @return \App\Http\Resources\ExtraReservationResource
     */
    public function show(Request $request,$id)
    {
        $extraReservation = ExtraReservation::find($id);

        return response()->json($extraReservation);
    }

    /**
     * @param \App\Http\Requests\ExtraReservationsUpdateRequest $request
     * @param \App\extraReservation $extraReservation
     * @return \App\Http\Resources\ExtraReservationResource
     */
    public function update(Request $request,$id)
    {
        $extraReservation = ExtraReservation::find($id);

        $extraReservation->update($request->validated());

        return  response()->json($extraReservation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\extraReservation $extraReservation
     * @return \App\Http\Resources\ExtraReservationResource
     */
    public function destroy(Request $request, ExtraReservation $extraReservation)
    {
        $extraReservation->delete();

        return  response()->json($extraReservation);
    }
}
