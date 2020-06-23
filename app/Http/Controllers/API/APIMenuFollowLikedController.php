<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuFollowLikedResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIMenuFollowLikedController extends Controller
{


    public function show(){
        $user = Auth::user();
        return new MenuFollowLikedResources($user);
    }
}
