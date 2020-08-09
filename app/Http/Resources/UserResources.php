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

        return [
            'id'=>$this->id,
            'fullname'=>$this->name,
            'username'=>$this->username,
            'avatar'=>$this->avatar,
            'email'=>$this->email,
            'gender'=>$this->gender,
            'birthday'=>$this->birthday,
            'address'=>$this->address,
            'password'=>$this->password,
            'level'=>$this->level,
            'created_at'=>(String)$this->created_at,
            'updated_at'=>(String)$this->updated_at,
        ];
    }
}
