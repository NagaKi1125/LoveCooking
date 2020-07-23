<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResources;
use App\Http\Resources\DishSearchResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APISearchController extends Controller
{
    public function searchDish(Request $req){
        $params = $req->only('data');

        if($params['data'] !== ""){
            $dish = DB::table('dishes')
            ->where('checked','1')
            ->orWhere('dish_name','like','%'.$params['data'].'%')
            ->orWhere('use','like','%'.$params['data'].'%')
            ->orWhere('description','like','%'.$params['data'].'%')
            ->get();
        }else{
            $dish = Dish::all();
        }

        return DishSearchResources::collection($dish);
    }


}
