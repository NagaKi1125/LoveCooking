<?php

namespace App\Http\Controllers;

use App\Dish;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $users = DB::table('users')->get();
        return view('admin.userManager',['users'=>$users]);
    }

    public function cateIndex(){
        $cate = DB::table('categories')->get();
        return view('admin.cateManager',['cate'=>$cate]);
    }

    public function marketIndex(){
        $mark = DB::table('markets')->get();
        return view('admin.marketManager',['mark'=>$mark]);
    }

    public function dishIndex(){
        $dish = DB::table('dishes')->where('checked','1')->get();
        $cate = DB::table('categories')->get();
        return view('admin.dishManager',['dish'=>$dish,'cate'=>$cate]);
    }

    public function cmtIndex(){
        $comment = DB::table('comments')->get();
        $users = DB::table('users')->get();
        $dish = DB::table('dishes')->get();
        return view('admin.comment',['comment'=>$comment,'users'=>$users,'dish'=>$dish]);
    }

    public function historyIndex(){
        $dishHistory = DB::table('dish_histories')->get();
        $dish = DB::table('dishes')->get();
        return view('admin.dishHistory',['dishHistory'=>$dishHistory,'dish'=>$dish]);
    }

    public function menuIndex(){
        $menu = DB::table('menus')->get();
        $users = DB::table('users')->get();
        $dish = DB::table('dishes')->get();
        return view('admin.menu',['menu'=>$menu,'dish'=>$dish,'users'=>$users]);
    }

    //liked list
    public function userLikedList($id){
        $userLikedList = DB::table('users')->join('user_liked_lists','users.id','=','user_liked_lists.user_id')
        ->select('users.*','user_liked_lists.*')->where('user_id',$id)->get();
        $dish = DB::table('dishes')->get();
        return view('admin.likedList',['userLikedList'=>$userLikedList,'dish'=>$dish]);
    }

    //follow list
    public function userFollowList($id){
        $userFollowList = DB::table('users')->join('follows','users.id','=','follows.user_id')
        ->select('users.*','follows.*')->where('user_id',$id)->get();
        $users = User::all();

        return view('admin.flow',['userFollowList'=>$userFollowList,'users'=>$users]);
    }
}
