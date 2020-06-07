<?php

namespace App\Http\Controllers;

use App\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $material_type = $request->input('material_type');
        $place = $request->input('place');
        Market::create([
            'material_type'=>$material_type,
            'place' => $place,
        ]);
        return redirect()->route('admin.market.index');
    }

    public function edit($id){
        $mark = Market::find($id);
        return view('admin.marketEdit',['mark'=>$mark]);
    }

    public function update($id,Request $request){
        $mark = Market::find($id);
        $material_type = $request->input('material_type');
        $place = $request->input('place');
        if($material_type == null)  $mark->material_type = $material_type;
        if($place == null) $mark->place = $place;

        $mark->update([
            'material_type'=>$material_type,
            'place'=>$place,
            ]);
        return redirect()->route('admin.market.index');
    }

    public function delete($id){
        $post =Market::find($id);
        $post->delete();
        return redirect()->route('admin.market.index');
    }
}
