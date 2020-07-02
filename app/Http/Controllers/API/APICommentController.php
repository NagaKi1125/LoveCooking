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

    public function update(Request $req, $cmtid){
        $user = Auth::user();
        $comment = Comment::find($cmtid);
        $params = $req->only('comment');

        if($user->id == $comment->user_id){
            $comment->update([
                'comment'=> $params['comment'],
            ]);
        }

        return response()->json($comment);
    }

    public function delete($cmtid){
        $user = Auth::user();
        $comment = Comment::find($cmtid);
        if($user->id == $comment->user_id){
            $comment->delete();
        }

        return response()->json([
            'success' => 'comment delete successfully',
        ]);
    }

}
