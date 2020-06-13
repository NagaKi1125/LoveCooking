<?php

namespace App\Http\Controllers;


use App\Category;
use App\Dish;
use App\DishHistory;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;

class DishController extends Controller
{
    public function addIndex(){
        $cate = DB::table('categories')->get();
        return view('admin.dishAdd',['cate'=>$cate]);
    }

    public function store(Request $req){
        $name = $req->input('dish_name');
        $des = $req->input('description');
        $use = $req->input('use');
        $material = $req->input('material');

        //steps and its image
        $steps = $req->input('steps');
        $steps_arr="";
        $step_imgs_path="";$i=0;
        foreach((array)$steps as $step){
            //step
            $steps_arr.=$step."_";
            //step_imgs
            $i++;
            if($req->hasFile('step_imgs_'.$i)){
                $step_img_name = $name.$req->file('step_imgs_'.$i)->getClientOriginalName();
                $req->file('step_imgs_'.$i)->move('upload',$step_img_name);
                $step_imgs_path .='upload/'.$step_img_name."_";

            }else $step_imgs_path.="null_";
        }


        //categories
        $cate_id = $req->input('category');
        $cate_arr="";
        foreach((array)$cate_id as $cid){
            $cate_arr.=$cid.'_';
        }

        //dish image
        if($req->hasFile('avatar')){
            $avaname = $name.$req->file('avatar')->getClientOriginalName();
            $req->file('avatar')->move('upload',$avaname);
            $avapath = 'upload/'.$avaname;

        }else $avapath="no";


        Dish::create([
            'dish_name'=>$name,
            'cate_id'=>$cate_arr,
            'avatar'=>$avapath,
            'description'=>$des,
            'use'=>$use,
            'material'=>$material,
            'steps'=>$steps_arr,
            'step_imgs'=>$step_imgs_path,
            'author'=>0,
            'liked_count'=>0,
        ]);

        return redirect()->route('admin.dish.index');
    }

    public function edit($id){
        $dish = Dish::find($id);
        $cate = Category::all();
        return view('admin.dishEdit',['dish'=>$dish,'cate'=>$cate]);
    }

    public function update(Request $req, $id){
        $dish = Dish::find($id);

        $name = $req->input('dish_name');
        $des = $req->input('description');
        $use = $req->input('use');
        $material = $req->input('material');

        //old image of steps
        $stepimg = explode('_',$dish->step_imgs);

        //steps and its image
        $steps = $req->input('steps');
        $steps_arr="";
        $step_imgs_path="";$i=0;
        foreach((array)$steps as $step){
            //step
            $steps_arr.=$step."_";
            //step_imgs
            $i++;
            if($req->hasFile('step_imgs_'.$i)){
                $step_img_name = $name.$req->file('step_imgs_'.$i)->getClientOriginalName();
                $req->file('step_imgs_'.$i)->move(public_path('upload'),$step_img_name);
                $step_imgs_path .='upload/'.$step_img_name."_";

            }else $step_imgs_path.=$stepimg[$i-1];
        }


        //categories
        $cate_id = $req->input('category');
        $cate_arr="";
        foreach((array)$cate_id as $cid){
            $cate_arr.=$cid.'_';
        }

        //dish image
        if($req->hasFile('avatar')){
            $avaname = $name.$req->file('avatar')->getClientOriginalName();
            $req->file('avatar')->move(public_path('upload'),$avaname);
            $avapath = 'upload/'.$avaname;

        }else $avapath=$dish->avatar;

        $dish->update([
            'dish_name'=>$name,
            'cate_id'=>$cate_arr,
            'avatar'=>$avapath,
            'description'=>$des,
            'use'=>$use,
            'material'=>$material,
            'steps'=>$steps_arr,
            'step_imgs'=>$step_imgs_path,
            'author'=>0,
            'liked_count'=>0,
        ]);

        return redirect()->route('admin.dish.index');
    }

    public function delete($id){
        $post =Dish::find($id);
        $post->delete();
        return redirect()->route('admin.dish.index');
    }
}
