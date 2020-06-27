<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIDishController extends Controller
{
    public function index(){
        $dish = DB::table('dishes')->where('checked','1')->get();
        return DishResources::collection($dish);
    }

    public function show($id)
    {
        $dish = Dish::find($id);
        return new DishResources($dish);
    }

    public function store(Request $request){

        $user = Auth::user();
        $dish = new Dish();
        $params = $request->only('dish_name','cate_id','avatar',
                'description','use','material','steps','step_imgs','author','liked_count');

        $dish->create([
            'dish_name'=>$params['dish_name'],
            'cate_id'=>$params['cate_id'],
            'avatar'=>'none',
            'description'=>$params['description'],
            'use'=>$params['use'],
            'material'=>$params['material'],
            'steps'=>'none',
            'step_imgs'=>'none',
            'author'=>$user->id,
            'liked_count'=>0,
            'checked'=>0,
        ]);

        return new DishResources($dish);
    }

    public function delete($id){

        $dish = Dish::findOrFail($id);
        $dish->delete();
        return 204;
    }
}
