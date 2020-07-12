<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIAuthController extends Controller
{
     /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $req){
        $credentials = $req->only('email','password');
        $token = null;
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['token'=>$token],Response::HTTP_OK);
    }

    public function register(RegisterFormRequest $req){
        $params =$req->only('email','name','password','username','gender','address','birthday');
        $user = New User();
        $user->email = $params['email'];
        $user->name = $params['name'];
        $user->password = Hash::make($params['password']);
        $user->username = $params['username'];
        $user->gender = $params['gender'];
        $user->address = $params['address'];
        $user->level = 2;
        $user->birthday = $params['birthday'];

        $user->save();

        return response()->json($user,Response::HTTP_OK);
    }


    public function user(Request $req)
    {
        $user = Auth::user();
        $dish_liked = DB::table('user_liked_lists')->where('user_id',$user->id)->pluck('dish_id_list')[0];
        $follow = DB::table('follows')->where('user_id',$user->id)->pluck('follow_id_list')[0];
        if ($user) {
            return response([
                "id"=> $user->id,
                "name"=> $user->name,
                "username"=> $user->username,
                "level"=> $user->level,
                "dish_liked"=>$dish_liked,
                "follow"=>$follow,
            ], Response::HTTP_OK);
        }

        return response(null, Response::HTTP_BAD_REQUEST);
    }

    public function logout(Request $req){
        $this->validate($req,['token'=>'required']);

        try{
            JWTAuth::invalidate($req->input('token'));
            return response()->json("You have successfully logged out.",Response::HTTP_OK);

        }catch(JWTException $e){
            return response()->json("Failed to logout. Please try again.",Response::HTTP_BAD_REQUEST);
        }
    }

    public function refresh(){
        return response(JWTAuth::getToken(),Response::HTTP_OK);
    }
}
