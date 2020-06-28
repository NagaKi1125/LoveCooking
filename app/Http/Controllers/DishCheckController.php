<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DishCheckController extends Controller
{
    public function index(){
        $dish = DB::table('dishes')->where('checked','0')->get();
        $cate = DB::table('categories')->get();
        return view('admin.dishChecked',['dish'=>$dish,'cate'=>$cate]);
    }

    public function check($id){
        $dish = Dish::find($id);
        $dish->update([
            'checked'=>1,
            ]);

        return redirect()->route('admin.dish.check.index');
    }

    public function delete($id){
        $dish = Dish::find($id);
        $dish->delete();
        return redirect()->route('admin.dish.check.index');
    }
}
