<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;

class APIMarketController extends Controller
{
    public function index(){
        return Market::all();
    }

    public function show($id)
    {
        return Market::find($id);
    }

    public function delete($id){

        $market = Market::findOrFail($id);
        $market->delete();
        return 204;
    }
}
