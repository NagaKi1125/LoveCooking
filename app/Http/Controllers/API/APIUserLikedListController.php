<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use App\User;
use App\UserLikedList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIUserLikedListController extends Controller
{
    public function love($id){
        $user = Auth::user();
        $userLoveDish = UserLikedList::all();
        $dish = Dish::find($id);
        $dishlike = $dish->liked_count;

        foreach($userLoveDish as $loveDish){
            if($loveDish->user_id == $user->id){
                $loveID = $loveDish->id;
                $lovedish = $loveDish->dish_id_list;
            }
        }

        $UserLikedDish = UserLikedList::find($loveID);

        if(strpos($lovedish,"_".$id."_") != false){

        }else{
            $like = $dish->liked_count;
            $dish->update([
                'liked_count' => $like+1,
            ]);

            $UserLikedDish->update([
                'dish_id_list'=>$lovedish.=$id."_",
            ]);
        }

        return response()->json($UserLikedDish);
    }

    public function loveless($id){
        $user = Auth::user();
        $userLoveDish = UserLikedList::all();
        $dish = Dish::find($id);

        foreach($userLoveDish as $loveDish){
            if($loveDish->user_id == $user->id){
                $loveID = $loveDish->id;
                $lovedish = $loveDish->dish_id_list;
            }
        }

        $UserLikedDish = UserLikedList::find($loveID);
        if(strpos($lovedish,"_".$id."_") != false){
            $like = $dish->liked_count;
            $dish->update([
                'liked_count' => $like-1,
            ]);
            $lovelist = str_replace($id."_","",$lovedish);
            $UserLikedDish->update([
                'dish_id_list'=>$lovelist,
            ]);
        }

        return response()->json($UserLikedDish);
    }
}
