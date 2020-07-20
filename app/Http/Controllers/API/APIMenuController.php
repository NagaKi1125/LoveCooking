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

    public function new(Request $req){
        $user = Auth::user();
        $params = $req->only('menu_date','breakfast_list','lunch_list','dinner_list');

        $menu = new Menu();
        $menu->user_id = $user->id;
        $menu->menu_date = $params['menu_date'];
        $menu->breakfast_list = "_".$params['breakfast_list'];
        $menu->lunch_list = "_".$params['lunch_list'];
        $menu->dinner_list = "_".$params['dinner_list'];

        $menu->save();
        return response()->json($menu);
    }

    public function add(Request $req,$id){
        $user = Auth::user();
        $params = $req->only('dish_id','date_time');
        $dish = Dish::find($params['dish_id']);
        $menu = Menu::find($id);

        if($user->id == $menu->user_id){
            if($params['date_time']==1){
                $menu->update([
                    'breakfast_list'=> $menu->breakfast_list.=$dish->id."_",
                ]);
            }elseif($params['date_time']==2){
                $menu->update([
                    'lunch_list'=> $menu->lunch_list.=$dish->id."_",
                ]);
            }else{
                $menu->update([
                    'dinner_list'=> $menu->dinner_list.=$dish->id."_",
                ]);
            }
        }

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
