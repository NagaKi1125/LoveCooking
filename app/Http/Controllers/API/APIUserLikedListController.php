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


        $dish->update([
            'love' => $dish->liked_count++,
        ]);
        $check=0;
        $lovelist = explode("_",$lovedish);
        foreach($lovelist as $ld){
            if($ld == $dish->id){
                $check++;
            }
        }

        $UserLikedDish = UserLikedList::find($loveID);
        if($check == 0){
            $userlovelist = $lovedish.$dish->id.'_';
        }else{
            $userlovelist = $lovedish;
        }
        $UserLikedDish->update([
            'dish_id_list' => $userlovelist,
        ]);

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


        if($dish->liked_count == 0){
            $dish->update([
                'love' => $dish->liked_count,
            ]);
        }else{
            $dish->update([
                'love' => $dish->liked_count--,
            ]);
        }


        $UserLikedDish = UserLikedList::find($loveID);
        $list="";
        $lovelist = explode('_',$lovedish);
        foreach( $lovelist as $loveli){
            if($loveli == $dish->id){
                $list=$list;
            }else{
                $list.=$loveli.'_';
            }
        }

        $UserLikedDish->update([
            'dish_id_list'=>$list,
        ]);

        return response()->json($UserLikedDish);
    }
}
