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

        if($user->id == $menu->user_id){
            if($params['date_time']==1){
                $menuBreakfast =explode("_",$menu->breakfast_list);
                $breakList ="";
                foreach($menuBreakfast as $mbr){
                    if($mbr==$dish->id){
                        $breakList=$breakList;
                    }else $breakList.="_".$mbr;
                }
                $menu->update([
                    'breakfast_list'=> $breakList,
                ]);
            }elseif($params['date_time']==2){
                $menuLunch = explode("_",$menu->lunch_list);
                $lunchList ="";
                foreach($menuLunch as $ml){
                    if($ml==$dish->id){
                        $lunchList=$lunchList;
                    }else $lunchList.="_".$ml;
                }
                $menu->update([
                    'lunch_list'=> $lunchList,
                ]);
            }else{
                $menuDinner = explode("_",$menu->dinner_list);
                $dinnerList ="";
                foreach($menuDinner as $md){
                    if($md==$dish->id){
                        $dinnerList=$dinnerList;
                    }else $dinnerList.="_".$md;
                }
                $menu->update([
                    'dinner_list'=> $dinnerList,
                ]);
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
