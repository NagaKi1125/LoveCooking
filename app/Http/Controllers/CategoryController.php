<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $category = $request->input('category');
        Category::create([
            'category'=>$category,
        ]);
        return redirect()->route('admin.categories.index');
    }

    public function edit($id){
        $cate = Category::find($id);
        return view('admin.cateEdit',['cate'=>$cate]);
    }

    public function update($id,Request $request){
        $cate = Category::find($id);
        $category = $request->input('category');
        if($category == null){
            $category = $cate->category;
        }
        $cate->update(['category'=>$category]);
        return redirect()->route('admin.categories.index');
    }

    public function delete($id){
        $post =Category::find($id);
        $post->delete();
        return redirect()->route('admin.categories.index');
    }
}
