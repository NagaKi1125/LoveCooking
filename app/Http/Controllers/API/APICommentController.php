<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APICommentController extends Controller
{

    public function comment(Request $req,$id){
        $user = Auth::user();
        $dish = Dish::find($id);
        $params = $req->only('comment');

        $cmt = new Comment();

        $cmt->dish_id = $dish->id;
        $cmt->user_id = $user->id;
        $cmt->comment = $params['comment'];

        $cmt->save();

        return response()->json($cmt);

    }

}
