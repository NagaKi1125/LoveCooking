<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }
    public function edit($id){
        $user = User::find($id);
        return view('admin.userEdit',compact('user'));
    }

    public function update($id,Request $request){
        $user = User::find($id);

        $level = $request->input('level');
        $name = $request->input('name');
        $username = $request->input('username');
        $birthday = $request->input('birthday');
        $gender = $request->input('gender');
        $address = $request->input('address');

        $user->update([
            'name'=>$name,
            'level'=>$level,
            'username'=>$username,
            'birthday'=>$birthday,
            'gender'=>$gender,
            'address'=>$address,
        ]);
        return redirect()->route('admin.index');
    }

    public function delete($id){
        $user = User::find($id);
        $user->update([
            'level'=>0,
        ]);
        return redirect()->route('admin.index');
    }
}
