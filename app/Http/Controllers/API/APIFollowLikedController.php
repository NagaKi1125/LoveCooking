<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowLikedResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIFollowLikedController extends Controller
{
    public function show(){
        $user = Auth::user();
        return new FollowLikedResources($user);
    }
}
