<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\User;
use App\Models\Agence;
use Illuminate\Http\Request;
use App\Http\Resources\AgenceResource;
use App\Http\Requests\AgenceStoreRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AgenceUpdateRequest;

class AgenceController extends Controller
{
    public function __construct(){
        // $this->middleware('auth:api')->except(['index','store']);
        // $this->authorizeResource(Agence::class,'agence');
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\AgenceResource
     */
    public function index(Agence $agence)
    {
        try{
            // $agences = Agence::paginate(5);
            $agences=$agence->get();
            // $agences=Agence::with('employes')->get();
            // $this->authorize('update',$agences);
            if(isset($agences)){
                // dd($agences);
                return  AgenceResource::collection($agences);
                // return response()->json(["agences"=>$agences]);
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
                $agence = Agence::create($request->validated());

                if ($agence) {
                    return new AgenceResource($agence);
                }
                else {
                    return response()->json(["message"=>"agence doesn't Created"],404);
                }
        } catch (Throwable $th) {
            return response()->json(["messages"=>$th->getMessage()],404);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function show(Request $request,Agence $agence)
    {
        dd($agence);
        // $agence = Agence::find($id);
        // $this->authorize('update',$agence);
        if($agence)
        return new AgenceResource($agence);
        return response()->json(["error"=>"agenece Not Found"],404);
    }

    /**
     * @param \App\Http\Requests\AgenceUpdateRequest $request
     * @param \App\Models\Agence $agence
     * @return \App\Http\Resources\AgenceResource
     */
    public function update(AgenceUpdateRequest $request,$id)
    {
        $agence = Agence::find($id);
        if (isset($agence))
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
        try{
        $agence=Agence::find($id);
        if($agence){
            $agence->delete();
            return new AgenceResource($agence);

        }else{
            return response()->json(["message"=>"agence not found"],404);
        }
        }catch(Exception $e){
            return response()->json(["Exception"=>$e->getMessage()],500);
        }
    }
}
