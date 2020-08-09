<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResources;
use App\Http\Resources\UserResources;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class APIUserController extends Controller
{
    public function index(){
        $user = User::all();
        return UserResources::collection($user);
    }

    public function update(Request $req){
        $user = User::find(Auth::user()->id);
        $params = $req->only('name','username','avatar','gender','birthday','address');

        $avatar = $params['avatar'];
        if($avatar != "" && $avatar != null && $avatar != "null"){
            $extension = explode('/',explode(':',substr($avatar,0,strpos($avatar,';')))[1])[1];
            $replace = substr($avatar,0,strpos($avatar,',')+1);
            $image = str_replace($replace,'',$avatar);
            $image = str_replace(' ','+',$image);
            $imageName = 'image'.$params['username'].time().'.'.$extension;
            Storage::disk('public')->put($imageName,base64_decode($image));
            $avatarName='upload/'.$imageName;
        }else{
            if(Auth::user()->avatar == null || Auth::user()->avatar == ""){
                $avatarName = "";
            }else{
                $avatarName = Auth::user()->avatar;
            }
        }


        $user->update([
            'name'=>$params['name'],
            'username'=>$params['username'],
            'avatar'=> $avatarName,
            'gender'=>$params['gender'],
            'birthday'=>$params['birthday'],
            'address'=>$params['address'],
        ]);

        if($user){
         return response()->json($user);
        }else return response("Update not success");
    }

	public function changePassword(Request $req){
		$user = User::find(Auth::user()->id);
        $params = $req->only('password','oldPass');
        if(Hash::check($params['oldPass'], $user->password)){
            $user->update([
                'password'=>Hash::make($params['password']),
            ]);
            return response("Password change success");
        }else{
            return response("Password change Failed");
        }
	}

    public function show()
    {
        $user =  Auth::user();
        return new UserResources($user);
    }

    public function userDishes(){
        $user = Auth::user();
        $dishes = DB::table('dishes')->where('author',$user->id)->get();
        return DishResources::collection($dishes);
    }

    public function delete($id){

        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
