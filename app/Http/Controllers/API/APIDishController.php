<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResources;
use App\User;
use App\UserLikedList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class APIDishController extends Controller
{
    public function index(){
        $dish = DB::table('dishes')->where('checked','1')->get();
        return DishResources::collection($dish);
    }

    public function show($id)
    {
        $dish = Dish::find($id);
        return new DishResources($dish);
    }

    public function store(Request $request){

        $user = Auth::user();
        $dish = new Dish();
        $params = $request->only('dish_name','cate_id','avatar',
                'description','use','material','steps','step_imgs');

        if($request->hasFile('avatar')){
            $avaname = $params['dish_name'].$request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move('upload',$avaname);
            $avapath = 'upload/'.$avaname;

        }else $avapath="no";
        $steppath='';$i=0;
        $stepsrray = explode("_",$params['steps']);
        foreach((array)$stepsrray as $img){

            if($request->hasFile('step_imgs'.$i)){
                    $stepname = $params['dish_name'].$request->file('step_imgs'.$i)->getClientOriginalName();
                    $request->file('step_imgs'.$i)->move('upload',$stepname);
                    $steppath .= 'upload/'.$stepname.'_';
            }else $steppath.="null_";
            $i++;
        }


        $dish->dish_name = $params['dish_name'];
        $dish->cate_id = $params['cate_id'];
        $dish->avatar = $avapath;
        $dish->description = $params['description'];
        $dish->use = $params['use'];
        $dish->material = $params['material'];
        $dish->steps = $params['steps'];
        $dish->step_imgs =$steppath;
        $dish->author = $user->id;
        $dish->liked_count = 0;
        $dish->checked = 0;

        $dish->save();

        return new DishResources($dish);
    }

    public function love($id){
        $user = Auth::user()->id;
        $userLoveDish = UserLikedList::find($user);
        $dish = Dish::find($id);

        $dish->update([
            'love' => $dish->liked_count++,
        ]);
        $check=0;
        $lovedish = explode("_",$userLoveDish->dish_id_list);
        foreach($lovedish as $ld){
            if($ld == $dish->id){
                $check++;
            }
        }
        if($check == 0){
            $lovelist = $userLoveDish->dish_id_list.$dish->id.'_';
        }else{
            $lovelist = $userLoveDish->dish_id_list;
        }
        $userLoveDish->update([
            'dish_id_list' => $lovelist,
        ]);

        return response()->json($userLoveDish);
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

    public function delete($id){

        $dish = Dish::findOrFail($id);
        $dish->delete();
        return 204;
    }
}
