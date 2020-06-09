<?php

namespace App\Http\Controllers\API;

use App\DishHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIDishHistoryController extends Controller
{
    public function index(){
        return DishHistory::all();
    }

    public function show($id)
    {
        return DishHistory::find($id);
    }

    public function delete($id){

        $dishHistory = DishHistory::findOrFail($id);
        $dishHistory->delete();
        return 204;
    }
}
