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

    public function store(Request $req){
        return Market::create($req->all());
    }

    public function update(Request $req,$id){
        $market = Market::findOrFail($id);
        $market->update($req->all());
    }
    public function delete($id){

        $market = Market::findOrFail($id);
        $market->delete();
        return 204;
    }
}
