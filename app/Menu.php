<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=[
        'user_id','menu_date','breakfast_list','lunch_list','dinner_list',
    ];
}
