<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResources;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class APICategoryController
{


    public function index(){
        $category = Category::all();
        return CategoryResources::collection($category);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $category = new Category();

        $category->category = $input['category'];

        $category->save();
        return $category;
    }

    public function show($id)
    {
        $category = Category::find($id);

       return new CategoryResources($category);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $category= Category::find($id);

        $category->category = $input['category'];
        $category->save();

        return new CategoryResources($category);
    }

    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();

        return response('Delete successfully');
    }
}
