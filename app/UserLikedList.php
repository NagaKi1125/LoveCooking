<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikedList extends Model
{
    protected $fillable = [
        'user_id','dish_id_list',
    ];
}
