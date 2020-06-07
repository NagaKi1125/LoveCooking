<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishHistory extends Model
{
    protected $fillable =[
        'dish_id','dh_posts','dh_images',
    ];
}
