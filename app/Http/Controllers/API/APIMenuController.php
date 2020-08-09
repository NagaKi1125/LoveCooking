<?php

namespace App\Http\Controllers\API;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResources;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIMenuController extends Controller
{
    public function show(){
        $user = Auth::user();
        $menu = DB::table('menus')->where('user_id',$user->id)->get();
        return MenuResources::collection($menu);
    }

    public function spinner(){
        $user = Auth::user();
        $menu = DB::table('menus')->where('user_id',$user->id)->get();
        return response()->json($menu);
    }

    public function new(Request $req){
        $user = Auth::user();
        $params = $req->only('menu_date');

        $menu = new Menu();
        $menu->user_id = $user->id;
        $menu->menu_date = $params['menu_date'];
        $menu->breakfast_list = "_";
        $menu->lunch_list = "_";
        $menu->dinner_list = "_";

        $menu->save();
        return response()->json($menu);
    }



    public function add(Request $req,$id){
        $params = $req->only('breakfast','lunch','dinner');
        $menu = Menu::find($id);

        $menu->update([
            'breakfast_list'=>"_".$params['breakfast'],
            'lunch_list'=>"_".$params['lunch'],
            'dinner_list'=>"_".$params['dinner'],
        ]);

        return response()->json($menu);
    }

    public function remove(Request $req,$id){
        $params = $req->only('breakfast','lunch','dinner');
        $menu = Menu::find($id);

        $menu->update([
            'breakfast_list'=>"_".$params['breakfast'],
            'lunch_list'=>"_".$params['lunch'],
            'dinner_list'=>"_".$params['dinner'],
        ]);

        return response()->json($menu);
    }

    public function delete($id){

        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json([
            'delete' =>"Delete Successfully",
        ]);
    }
}
