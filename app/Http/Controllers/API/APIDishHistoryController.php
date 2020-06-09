<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\DishHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIDishHistoryController extends Controller
{
    public function index(){
        return DishHistory::all();
    }

    public function show($id)
    {
        return DishHistory::find($id);
    }

    public function store(Request $req)
    {
        $input = $req->all();
        $id = $input['dish_id'];
        $dish = Dish::find($id);

        return  DishHistory::create([
            'dish_id' => $id,
            'dh_posts'=> $input['dh_posts'],
            'dh_images' => $dish->avatar,
        ]);
    }

    public function update(Request $req, $id)
    {
        $dishHistory = DishHistory::findOrFail($id);
        $dishHistory->update($req->all());

        return $dishHistory;
    }

    public function delete($id){

        $dishHistory = DishHistory::findOrFail($id);
        $dishHistory->delete();
        return 204;
    }
}
