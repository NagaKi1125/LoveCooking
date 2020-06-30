<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function delete($id){
        $cmt = Comment::find($id);
        $cmt->delete();
        return redirect()->route('admin.comment.index');
    }
}
