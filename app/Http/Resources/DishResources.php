<?php

namespace App\Http\Resources;

use App\DishHistory;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class DishResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $dishhis = DB::table('dish_histories')->select('dish_histories.dh_posts')->where('dish_id',$this->id)->get();
        $usercmt = DB::table('comments')
            ->join('users','comments.user_id','=','users.id')
            ->join('dishes','comments.dish_id','=','dishes.id')
            ->select('users.name','comments.id','comments.comment','comments.created_at','comments.updated_at')
            ->where('dish_id',$this->id)->get();
        $cate_id = explode('_',$this->cate_id);
        $cate_list ="";
        $category = DB::table('categories')->get();
        foreach($cate_id as $cai){
            foreach($category as $cate){
                if($cai == $cate->id){
                    $cate_list.=$cate->category."_";
                }
            }
        }

        return [
            'id'=>$this->id,
            'dish_name'=>$this->id,
            'cate_id'=>$cate_list,
            'avatar'=>$this->avatar,
            'description'=>$this->description,
            'use'=>$this->use,
            'material'=>$this->material,
            'steps'=>$this->steps,
            'step_imgs'=>$this->step_imgs,
            'author'=>$this->author,
            'liked_count'=>$this->liked_count,
            //history
            'history'=>$dishhis,
            'cmt'=>$usercmt,
            'created_at'=>(String)$this->created_at,
            'updated_at'=>(String)$this->updated_at,
        ];
    }
}
