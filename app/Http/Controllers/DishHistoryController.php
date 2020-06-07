<?php

namespace App\Http\Controllers;

use App\Dish;
use App\DishHistory;
use Illuminate\Http\Request;

class DishHistoryController extends Controller
{
    public function addIndex(){
        $dish = Dish::all();
        return view('admin.dishHistoryAdd',['dish'=>$dish]);
    }

    public function store(Request $req){
        $post = $req->input('dh_posts');
        $id = $req->input('dish_id');
        $dish = Dish::find($id);
        $name = $dish->dish_name;
        $image = $dish->avatar;

        DishHistory::create([
            'dish_id' => $id,
            'dh_posts'=> $post,
            'dh_images' => $image,
        ]);

        return redirect()->route('admin.history.index');
    }
}
