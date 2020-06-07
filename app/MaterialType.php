<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $fillable = [
        'material_list','material_type_list_id','dish_id',
    ];
}
