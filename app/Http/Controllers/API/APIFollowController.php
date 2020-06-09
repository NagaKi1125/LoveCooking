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

    public function delete($id){

        $follow = Follow::findOrFail($id);
        $follow->delete();
        return 204;
    }
}
