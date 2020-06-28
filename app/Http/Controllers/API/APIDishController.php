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
                'description','use','material','steps','step_imgs');

        if($request->hasFile('avatar')){
            $avaname = $params['dish_name'].$request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move('upload',$avaname);
            $avapath = 'upload/'.$avaname;

        }else $avapath="no";

        $dish->dish_name = $params['dish_name'];
        $dish->cate_id = $params['cate_id'];
        $dish->avatar = $avapath;
        $dish->description = $params['description'];
        $dish->use = $params['use'];
        $dish->material = $params['material'];
        $dish->steps = $params['steps'];
        $dish->step_imgs = 'none';
        $dish->author = $user->id;
        $dish->liked_count = 0;
        $dish->checked = 0;

        $dish->save();

        return new DishResources($dish);
    }

    public function delete($id){

        $dish = Dish::findOrFail($id);
        $dish->delete();
        return 204;
    }
}
