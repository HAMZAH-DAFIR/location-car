<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::all()->paginate(10);
        if(count($cars)){
            return  CarController::collection($cars);
        }else{
            return response()->json(["message"=>"note found"],404);
        }

    }

    /**
     * @param \App\Http\Requests\CarStoreRequest $request
     * @return \App\Http\Resources\CarResource
     */
    public function store(CarStoreRequest $request)
    {
        $car = Car::create($request->validated());

        return new CarResource($car);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Car $car
     * @return \App\Http\Resources\CarResource
     */
    public function show(Request $request,$id)
    {
        $car = Car::find($id);

        return new CarResource($car);
    }

    /**
     * @param \App\Http\Requests\CarUpdateRequest $request
     * @param \App\Models\Car $car
     * @return \App\Http\Resources\CarResource
     */
    public function update(CarUpdateRequest $request,$id)
    {
        $car = Car::find($id);

        $car->update($request->validated());

        return new CarResource($car);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Car $car
     * @return \App\Http\Resources\CarResource
     */
    public function destroy(Request $request, Car $car)
    {
        $car->delete();

        return new CarResource($car);
    }
}
