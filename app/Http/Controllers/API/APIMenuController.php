<?php

namespace App\Http\Controllers\API;

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

    public function store(Request $req){
        return Menu::create($req->all());
    }

    public function update(Request $req,$id){
        $menu = Menu::findOrFail($id);
        $menu->update($req->all());
    }

    public function delete($id){

        $menu = Menu::findOrFail($id);
        $menu->delete();
        return 204;
    }
}
