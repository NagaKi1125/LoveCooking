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
        $menu->breakfast_list = $params['breakfast_list'];
        $menu->lunch_list = $params['lunch_list'];
        $menu->dinner_list = $params['dinner_list'];

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
        $user = Auth::user();
        $params = $req->only('dish_id','date_time');
        $dish = Dish::find($params['dish_id']);
        $menu = Menu::find($id);

        $breakfast = $menu->breakfast_list;
        $lunch = $menu->lunch_list;
        $dinner = $menu->dinner_list;

        if($user->id == $menu->user_id){
            if($params['date_time']==1){
                if(strpos($breakfast,$params['dish_id']) !== false){
                    $breakfast .= str_replace($dish->id."_","",$breakfast);
                }else{
                    $breakfast = $breakfast;
                }

                $menu->update([
                    'breakfast_list'=> $breakfast,
                ]);

            }elseif($params['date_time']==2){
                if($params['date_time']==1){
                    if(strpos($lunch,$params['dish_id']) !== false){
                        $lunch .= str_replace($dish->id."_","",$lunch);
                    }else{
                        $lunch = $lunch;
                    }

                    $menu->update([
                        'lunch_list'=> $lunch,
                    ]);
                }
            }else{
                if($params['date_time']==1){
                    if(strpos($dinner,$params['dish_id']) !== false){
                        $dinner .= str_replace($dish->id."_","",$dinner);
                    }else{
                        $dinner = $dinner;
                    }

                    $menu->update([
                        'dinner_list'=> $dinner,
                    ]);
                }
            }
        }
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
