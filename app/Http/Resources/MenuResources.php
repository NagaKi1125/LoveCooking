<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class MenuResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $br_id = explode('_',$this->breakfast_list);
        $lun_id = explode('_',$this->lunch_list);
        $din_id = explode('_',$this->dinner_list);
        $br_list = $lun_list = $din_list ="";
        $dishes = DB::table('dishes')->get();
        //breakfast
        foreach($br_id as $bri){
            foreach($dishes as $dish){
                if($bri == $dish->id){
                    $br_list.=$dish->dish_name."+".$dish->id."_";
                }
            }
        }
        //lunch
        foreach($lun_id as $lui){
            foreach($dishes as $dish){
                if($lui == $dish->id){
                    $lun_list.=$dish->dish_name."+".$dish->id."_";
                }
            }
        }
        //dinner
        foreach($din_id as $din){
            foreach($dishes as $dish){
                if($din == $dish->id){
                    $din_list.=$dish->dish_name."+".$dish->id."_";
                }
            }
        }
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'menu_date'=>$this->menu_date,
            'breakfast_list'=>$br_list,
            'lunch_list'=>$lun_list,
            'dinner_list'=>$din_list,
            'created_at'=>(String)$this->created_at,
            'updated_at'=>(String)$this->updated_at,

        ];
    }
}
