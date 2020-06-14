<?php

namespace App\Http\Resources;

use App\Dish;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $follow = DB::table('follows')->select('id')->where('user_id',$this->id)->get();


        $dish_liked = DB::table('user_liked_lists')->select('dish_id_list')->where('user_id',$this->id)->get();
        $dish_list = explode('_',$dish_liked);
        $dish = Dish::all();
        $dish_liked_list = "";
        foreach($dish_list as $dili){
            foreach($dish as $di){
                if($dili == $di->id){
                    $dish_liked_list.=$di->dish_name."_";
                }
            }
        }

        return [
            'id'=>$this->id,
            'fullname'=>$this->name,
            'username'=>$this->username,
            'email'=>$this->email,
            'gender'=>$this->gender,
            'birthday'=>$this->birthday,
            'address'=>$this->address,
            'password'=>$this->password,
            'level'=>$this->level,
            'follow_list_names'=>$follow,
            'dish_liked_list'=>$dish_liked_list,
            'created_at'=>(String)$this->created_at,
            'updated_at'=>(String)$this->updated_at,
        ];
    }
}
