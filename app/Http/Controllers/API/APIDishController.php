<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResource;

use Illuminate\Http\Request;


class APIDishController extends Controller
{
    public function index(){
        $dish = Dish::all();
        return DishResources::collection($dish);
    }

    public function show($id)
    {
        return Dish::find($id);
    }

    public function delete($id){

        $dish = Dish::findOrFail($id);
        $dish->delete();
        return 204;
    }
}
