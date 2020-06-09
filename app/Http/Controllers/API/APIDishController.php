<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIDishController extends Controller
{
    public function index(){
        return Dish::all();
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
