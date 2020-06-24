<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIUserController extends Controller
{
    public function index(){
        $user = User::all();
        return UserResources::collection($user);
    }

    public function show($id)
    {
        $user =  Auth::user();
        return new UserResources($user);
    }

    public function delete($id){

        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
