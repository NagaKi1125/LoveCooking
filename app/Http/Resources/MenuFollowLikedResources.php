<?php

namespace App\Http\Resources;

use App\Dish;
use App\Follow;
use App\Menu;
use App\User;
use App\UserLikedList;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class MenuFollowLikedResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $dishes = DB::table('dishes')->get();

        //user's follow list
        $follow = DB::table('follows')->where('user_id',$this->id)->pluck('follow_id_list')[0];
        $fo_list = explode('_',$follow);
        //$fo_list = explode('_',$fo_list[3]);
        $follow_list = "";
        $user = User::all();
        foreach($fo_list as $fli){
            foreach($user as $us){
                if($fli == $us->id){
                    $follow_list.=$us->id."+".$us->name."_";
                }
            }
        }


        //user's dishes liked
        $dish_liked = DB::table('user_liked_lists')->where('user_id',$this->id)->pluck('dish_id_list')[0];
        $dish_list = explode('_',$dish_liked);
        //$di_list = explode('_',$dish_list[3]);
        $dish_liked_list = "";
        foreach($dish_list as $dili){
            foreach($dishes as $di){
                if($dili == $di->id){
                    $dish_liked_list.=$di->id."+".$di->dish_name."+".$di->avatar."_";
                }
            }
        }
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'follow_list_names'=>$follow_list,
            'dish_liked_list'=>$dish_liked_list,
        ];
    }
}
