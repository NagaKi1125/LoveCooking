<?php

namespace App\Http\Resources;

use App\DishHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        Carbon::setLocale("vi");

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
                    $cate_list.=$cate->id."#".$cate->category."_";
                }
            }
        }
        $user = User::all();
        if($this->author == 0){
            $name = "Admin - Love Cooking";
        }else{
            foreach($user as $us){
                if($us->id == $this->author){
                    $name = $us->name;
                }
            }
        }


        return [
            'id'=>$this->id,
            'dish_name'=>$this->dish_name,
            'cate_id'=>$cate_list,
            'avatar'=>$this->avatar,
            'description'=>$this->description,
            'use'=>$this->use,
            'material'=>$this->material,
            'steps'=>$this->steps,
            'step_imgs'=>$this->step_imgs,
			'author_id'=>$this->author,
            'author'=>$name,
            'liked_count'=>$this->liked_count,
			'checked'=>$this->checked,
            //history
            'history'=>$dishhis,
            //'cmt'=>$usercmt,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans()."_".Carbon::parse($this->created_at)->getPreciseTimestamp(3),
            'updated_at'=>Carbon::parse($this->updated_at)->diffForHumans()."_".Carbon::parse($this->updated_at)->getPreciseTimestamp(3),
        ];
    }
}
