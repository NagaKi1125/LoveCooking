<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\UserLikedList;
use Illuminate\Http\Request;

class APIUserLikedListController extends Controller
{
    public function index(){
        return UserLikedList::all();
    }

    public function show($id)
    {
        return UserLikedList::find($id);
    }

    public function delete($id){

        $userLikedList = UserLikedList::findOrFail($id);
        $userLikedList->delete();
        return 204;
    }
}
