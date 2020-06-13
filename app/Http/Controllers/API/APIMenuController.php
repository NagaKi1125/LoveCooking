<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResources;
use App\Menu;
use Illuminate\Http\Request;


class APIMenuController extends Controller
{
    public function index(){
        $menu = Menu::all();
        return MenuResources::collection($menu);
    }

    public function show($id)
    {
        return Menu::find($id);
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
