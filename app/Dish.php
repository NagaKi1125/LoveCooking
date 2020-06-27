<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'dish_name','cate_id','avatar','description','material','steps','use','step_imgs','author','liked_count','checked',
    ];
}
