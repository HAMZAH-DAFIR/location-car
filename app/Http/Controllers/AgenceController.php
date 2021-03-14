<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\Agence;
use Illuminate\Http\Request;
use App\Http\Resources\AgenceResource;
use App\Http\Requests\AgenceStoreRequest;
use App\Http\Requests\AgenceUpdateRequest;

class AgenceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\AgenceResource
     */
    public function index(Request $request)
    {
        try{
            $agences = Agence::paginate(5);
            if(isset($agences)){
                return  AgenceResource::collection($agences);
            }else{
                return response()->json(["message"=>"Pas d'agence "]);
            }
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    /**
     * @param \App\Http\Requests\AgenceStoreRequest $request
     * @return \App\Http\Resources\AgenceResource
     */
    public function store(AgenceStoreRequest $request)
    {

        dd("hello");
        try {

            if(!$request->validated->fails){
                $agence = Agence::create($request->validated());
                return response()->json(["message"=>"agence was created"]);
            }else{
                return response()->json(["message"=>"exception"]);
            }
        } catch (Throwable $th) {
            return response()->json(["message"=>"exception"]);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function show(Request $request, $id)
    {
        $agence = Agence::find($id);

        return new AgenceResource($agence);
    }

    /**
     * @param \App\Http\Requests\AgenceUpdateRequest $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function update(AgenceUpdateRequest $request,$id)
    {
        $agence = Agence::find($id);

        $agence->update($request->validated());

        return new AgenceResource($agence);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function destroy(Request $request,$id)
    {
        $agence=Agence::findOrfail($id);
        $agence->delete();

        return new AgenceResource($agence);
    }
}
