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
        try {
            $validate=validator($request->all());
            if(!$validate->fails()){
                $agence = Agence::create($request->validated());

                if($agence){
                    return response()->json(["message"=>"agence was Created"],201);
                }else{
                    return response()->json(["message"=>"agence doesn't Created"],200);
                }

            }else{
                return response()->json($validate);
            }
        } catch (Throwable $th) {
            return response()->json(["message"=>"exception"],404);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function show(Request $request, $id)
    {
        try{
        $agence = Agence::find($id);
        if(isset($agence)){
            return new AgenceResource($agence);
        }else{
            return response()->json(["message"=>"not found"],200);
        }
    }catch(Exception $e){
        return response()->json(["errors"=>$e->getMessage()]);
    }
    }

    /**
     * @param \App\Http\Requests\AgenceUpdateRequest $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function update(AgenceUpdateRequest $request,$id)
    {
        try{
        $agence = Agence::find($id);
        if($agence){
            $agence->update($request->validated());
            return new AgenceResource($agence);
        }else{
            return response()->json(["message"=>"agence not found"],404);
        }
        }catch(Exception $e){
            return response($e->getMessage(),404);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function destroy(Request $request,$id)
    {
        $agence=Agence::find($id);
        if($agence){
            $agence->delete();
            return response()->json(["message"=>"the agence was deleted succesfully"]);
        }else{
            return response()->json(["message"=>"agence not found"],404);
        }



    }
}
