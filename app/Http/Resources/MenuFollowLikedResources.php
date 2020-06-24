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
        //User's Menu
        $menuBreakfast = DB::table('menus')->where('user_id',$this->id)->pluck('breakfast_list')[0];
        $menuLunch = DB::table('menus')->where('user_id',$this->id)->pluck('lunch_list')[0];
        $menuDinner = DB::table('menus')->where('user_id',$this->id)->pluck('dinner_list')[0];
        $br_id = explode('_',$menuBreakfast);    //$br_id = explode('_',$br_id[3]);
        $lun_id = explode('_',$menuLunch); // $lun_id = explode('_',$lun_id[3]);
        $din_id = explode('_',$menuDinner); //$din_id = explode('_',$din_id[3]);
        $br_list = $lun_list = $din_list ="";

        $dishes = DB::table('dishes')->get();
        //breakfast
        foreach($br_id as $bri){
            foreach($dishes as $dish){
                if($bri == $dish->id){
                    $br_list.=$dish->dish_name."_";
                }
            }
        }
        //lunch
        foreach($lun_id as $lui){
            foreach($dishes as $dish){
                if($lui == $dish->id){
                    $lun_list.=$dish->dish_name."_";
                }
            }
        }
        //dinner
        foreach($din_id as $din){
            foreach($dishes as $dish){
                if($din == $dish->id){
                    $din_list.=$dish->dish_name."_";
                }
            }
        }

        //user's follow list
        $follow = DB::table('follows')->where('user_id',$this->id)->pluck('follow_id_list')[0];
        $fo_list = explode('_',$follow);
        //$fo_list = explode('_',$fo_list[3]);
        $follow_list = "";
        $user = User::all();
        foreach($fo_list as $fli){
            foreach($user as $us){
                if($fli == $us->id){
                    $follow_list.=$us->name."_";
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
                    $dish_liked_list.=$di->dish_name."_";
                }
            }
        }
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'follow_list_names'=>$follow_list,
            'dish_liked_list'=>$dish_liked_list,
            'menu_list'=>[
                'breakfast_list'=>$br_list,
                'lunch_list'=>$lun_list,
                'dinner_list'=>$din_list,
            ]
        ];
    }
}
