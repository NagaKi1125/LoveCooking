<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCommentResources;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APICommentController extends Controller
{

    public function show(Request $req, $id){
        // $usercmt = DB::table('comments')
        //     ->join('users','comments.user_id','=','users.id')
        //     ->join('dishes','comments.dish_id','=','dishes.id')
        //     ->select('users.name','users.avatar','comments.user_id','comments.id','comments.comment','comments.created_at','comments.updated_at')
        //     ->where('dish_id',$id)->get();

        $cmt = Comment::where("dish_id",$id)->get();


        return UserCommentResources::collection($cmt);
    }

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
