<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;



class UserCommentResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $name = User::find($this->user_id);
        $usName = $name->name;
		$avatar = $name->avatar;
		$userId = $name->id;

        Carbon::setLocale("vi");
        return [
			'id'=>$this->id,
            'name'=>$usName,
			'user_id'=>$userId,
			'avatar'=>$avatar,
            'comment'=>$this->comment,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans()."_".Carbon::parse($this->created_at)->getPreciseTimestamp(3),
            'updated_at'=>Carbon::parse($this->updated_at)->diffForHumans()."_".Carbon::parse($this->updated_at)->getPreciseTimestamp(3),
        ];
    }
}
