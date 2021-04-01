<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;

class AuthAuthController extends Controller
{
    // use Validator;
    public function register(Request $request){
        $validate=$request->all();

        // $validate=$request->validate([
        //     'name'=>'required|string|min:5|max:50',
        //     'email'=>'required|email|unique:users',
        //     'password'=>'required|string'
        // ]);
        // dd('hello');
        // $validate['password']=bcrypt($validate['password']);
        $user=User::create($validate);

        $token=$user->createToken('api_token')->accessToken;
        return response()->json(['token'=>$token],200);

    }
    public function login(Request $request){

        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

            if($validator->fails()){
                return response()->json(["erros"=>$validator->errors()->all()]);
            }
            $user=User::where('email',$request->email)->first();
            if($user){
                if(Hash::check($request->password, $user->password)){
                $token=$user->createToken('api_token')->accessToken;
                return response()->json(['token'=>$token]);
                }else{
                    return response()->json(["message"=>"password invalid"],422) ;
                }
            }else{
                return response()->json(["message"=>"user doesn't exist!!"],422);
            }


    }
    public function details(Request $reques){
        return response()->json(["user"=>auth()->user()]);
    }
}
