<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;

class APIMenuController extends Controller
{
    public function index(){
        return Menu::all();
    }

    public function show($id)
    {
        return Menu::find($id);
    }

    public function delete($id){

        $menu = Menu::findOrFail($id);
        $menu->delete();
        return 204;
    }
}
