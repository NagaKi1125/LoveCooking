<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\User;
use Illuminate\Http\Request;

class APIUserController extends Controller
{
    public function index(){
        return User::all();
        //return UserResources::collection($user);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function delete($id){

        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
