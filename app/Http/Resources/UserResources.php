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
        $follow = DB::table('follows')->select('follow_id_list')->where('user_id',$this->id)->get();
        $foll_list = explode('_',$follow);
        $user = User::all();
        $follow_list = "";
        foreach($foll_list as $foll){
            foreach($user as $us){
                if($foll == $us->id){
                    $follow_list.=$us->name."_";
                }
            }
        }

        $dish_liked = DB::table('user_liked_lists')->select('id')->where('user_id',$this->id)->get();

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
            'follow_list_names'=>$follow_list,
            'dish_liked_list'=>$dish_liked,
            'created_at'=>(String)$this->created_at,
            'updated_at'=>(String)$this->updated_at,
        ];
    }
}
