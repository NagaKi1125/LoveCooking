<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Dish;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                'description','use','material','steps','step_imgs1','step_imgs2','step_imgs3',
                'step_imgs4','step_imgs5','step_imgs6','step_imgs7','step_imgs8','step_imgs9','step_img10');


        $avatar = $params['avatar'];
        if($avatar != "" && $avatar != null && $avatar != "null"){
            $extension = explode('/',explode(':',substr($avatar,0,strpos($avatar,';')))[1])[1];
            $replace = substr($avatar,0,strpos($avatar,',')+1);
            $image = str_replace($replace,'',$avatar);
            $image = str_replace(' ','+',$image);
            $imageName = 'image'.$params['dish_name'].time().'.'.$extension;
            Storage::disk('public')->put($imageName,base64_decode($image));
        }else{
            $imageName= "null";
        }

        //avatar

        $steppath='';$i=1;
        $stepsrray = explode("_",$params['steps']);
        for($i = 1;$i<=count($stepsrray);$i++){
            if($params['step_imgs'.$i]!= null && $params['step_imgs'.$i] != "null"){
                $stepExtension = explode('/',explode(':',substr($params['step_imgs'.$i],0,strpos($params['step_imgs'.$i],';')))[1])[1];
                $stepreplace = substr($params['step_imgs'.$i],0,strpos($params['step_imgs'.$i],',')+1);
                $stepimage = str_replace($stepreplace,'',$params['step_imgs'.$i]);
                $stepimage = str_replace(' ','+',$stepimage);
                $stepimageName = $i.'step'.time().'image'.$params['dish_name'].time().'.'.$stepExtension;
                Storage::disk('public')->put($stepimageName,base64_decode($stepimage));
                $steppath.='upload/'.$stepimageName."_";
            }else $steppath.="null_";

        }
		// in android end point of dish will have 10 values of step images =))))

        $dish->dish_name = $params['dish_name'];
        $dish->cate_id = "_".$params['cate_id'];
        $dish->avatar = 'upload/'.$imageName;
        $dish->description = $params['description'];
        $dish->use = $params['use'];
        $dish->material = $params['material'];
        $dish->steps = $params['steps'];
        $dish->step_imgs =$steppath;
        $dish->author = $user->id;
        $dish->liked_count = 0;
        $dish->checked = 0;

        if($dish->save()){
            return new DishResources($dish);
        }else return response("Failed");

    }


    public function update(Request $req,$id){

        $user = Auth::user();
        $dish = Dish::find($id);
        $params = $req->only('dish_name','cate_id','avatar',
        'description','use','material','steps','step_imgs1','step_imgs2','step_imgs3',
        'step_imgs4','step_imgs5','step_imgs6','step_imgs7','step_imgs8','step_imgs9','step_img10');

        $avatar = $params['avatar'];
        if($avatar != "" && $avatar != null && $avatar != "null"){
            $extension = explode('/',explode(':',substr($avatar,0,strpos($avatar,';')))[1])[1];
            $replace = substr($avatar,0,strpos($avatar,',')+1);
            $image = str_replace($replace,'',$avatar);
            $image = str_replace(' ','+',$image);
            $imageName = 'image'.$params['dish_name'].time().'.'.$extension;
            Storage::disk('public')->put($imageName,base64_decode($image));
        }else{
            $imageName= "null";
        }

        $steppath='';$i=1;
        $stepsrray = explode("_",$params['steps']);
        for($i = 1;$i<=count($stepsrray);$i++){
            if($params['step_imgs'.$i]!= null && $params['step_imgs'.$i] != "null"){
                $stepExtension = explode('/',explode(':',substr($params['step_imgs'.$i],0,strpos($params['step_imgs'.$i],';')))[1])[1];
                $stepreplace = substr($params['step_imgs'.$i],0,strpos($params['step_imgs'.$i],',')+1);
                $stepimage = str_replace($stepreplace,'',$params['step_imgs'.$i]);
                $stepimage = str_replace(' ','+',$stepimage);
                $stepimageName = $i.'step'.time().'image'.$params['dish_name'].time().'.'.$stepExtension;
                Storage::disk('public')->put($stepimageName,base64_decode($stepimage));
                $steppath.='upload/'.$stepimageName."_";
            }else $steppath.="null_";
        }

        $dish->dish_name = $params['dish_name'];
        $dish->cate_id = "_".$params['cate_id'];
        $dish->avatar = 'upload/'.$imageName;
        $dish->description = $params['description'];
        $dish->use = $params['use'];
        $dish->material = $params['material'];
        $dish->steps = $params['steps'];
        $dish->step_imgs =$steppath;
        $dish->author = $user->id;
        $dish->liked_count = 0;
        $dish->checked = 0;

        if($dish->save()){
            return new DishResources($dish);
        }else return response("Failed");


    }

    public function delete($id){

        $dish = Dish::findOrFail($id);
        $dish->delete();
        return 204;
    }
}
