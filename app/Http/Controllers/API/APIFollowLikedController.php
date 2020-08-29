<?php

namespace App\Http\Controllers\API;

use App\Follow;
use App\Http\Controllers\Controller;
use App\Http\Resources\FollowLikedResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIFollowLikedController extends Controller
{
    public function show(){
        $user = Auth::user();
        return new FollowLikedResources($user);
    }

    public function unfollow($fid){
        $user = Auth::user();
        $follow_id = DB::table('follows')->where('user_id',$user->id)->pluck('id')[0];
        $follow = Follow::find($follow_id);

        if(strpos($follow->follow_id_list,"_".$fid."_") != false){
            $follow->update([
                'follow_id_list'=> str_replace($fid."_","",$follow->follow_id_list),
            ]);
        }
        return response()->json($follow);

    }

    public function follow($fid){
        $user = Auth::user();
        $follow_id = DB::table('follows')->where('user_id',$user->id)->pluck('id')[0];
        $follow = Follow::find($follow_id);

        if(strpos($follow->follow_id_list,"_".$fid."_") != false){
            
        }else{
            $follow->update([
                'follow_id_list'=> $follow->follow_id_list.$fid."_",
            ]);
            return response()->json($follow);
        }


    }
}
