<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class DishSearchResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $user = User::all();
        if($this->author == 0){
            $name = "Admin - Love Cooking";
        }else {
            foreach($user as $u){
                if($u->id == $this->author) $name = $u->name;
            }
        }

        return [
            'id' => $this->id,
            'name'=>$this->dish_name,
            'description'=>$this->description,
            'use'=>$this->use,
            'avatar'=>$this->avatar,
            'author'=>$this->author,
            'create'=>$this->created_at,
        ];
    }
}
