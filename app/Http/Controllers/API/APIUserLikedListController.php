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

        foreach($userLoveDish as $loveDish){
            if($loveDish->user_id == $user->id){
                $loveID = $loveDish->id;
                $lovedish = $loveDish->dish_id_list;
            }
        }

        $UserLikedDish = UserLikedList::find($loveID);
        if(strpos($lovedish,$id)!== false){
            $userlovelist = $lovedish;
            $UserLikedDish->update([
                'dish_id_list' => $userlovelist,
            ]);

            $dish->update([
                'liked_count' => $dish->liked_count++,
            ]);
        }else{
            $userlovelist = $lovedish.$dish->id.'_';
            $UserLikedDish->update([
                'dish_id_list' => $userlovelist,
            ]);

            $dish->update([
                'liked_count' => $dish->liked_count++,
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
        if(strpos($lovedish,$id)!== false){
            $userlovelist = str_replace($dish->id."_","",$lovedish);
        }else{
            $userlovelist = $lovedish;
        }


        if($dish->liked_count == 0){
            $dish->update([
                'liked_count' => $dish->liked_count--,
            ]);
            $UserLikedDish->update([
                'dish_id_list'=>$userlovelist,
            ]);
        }else{
            $dish->update([
                'liked_count' => $dish->liked_count--,
            ]);
            $UserLikedDish->update([
                'dish_id_list'=>$userlovelist,
            ]);
        }

        return response()->json($UserLikedDish);
    }
}
