<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;



class APIRegisterController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $req){
        $validator = FacadesValidator::make($req->all(),[
            'name' =>'required',
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Erorr .',$validator->errors());
        }

        $input = $req->all();
        $input['password'] =Hash::make($input['password']);
        $user = User::Create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'level' => 2,
            'dishes_liked'=> 'null',
            'password' => Hash::make($input['password']),
        ]);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success,'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $req){
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
           // $user = Auth::user()->id;
            $user = User::find(Auth::user()->id);
            $success['token'] = $user->createToken('MyApp')->accessToken;

            return $this->sendResponse($success,'User login successfully');
        }else{
            return  $this->sendError('Unauthorised',['error'=>'Unauthorised']);
        }
    }
}
