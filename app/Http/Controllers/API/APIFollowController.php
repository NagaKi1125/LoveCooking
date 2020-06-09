<?php

namespace App\Http\Controllers\API;

use App\Follow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;

class APIFollowController extends Controller
{
    public function index(){
        return Follow::all();
    }

    public function show($id)
    {
        return Follow::find($id);
    }

    public function store(Request $req){
        return Follow::create($req->all());
    }

    public function update(Request $req, $id){
        $follow = Follow::findOrFail($id);
        $follow->update($req->all);
    }

    public function delete($id){

        $follow = Follow::findOrFail($id);
        $follow->delete();
        return 204;
    }
}
