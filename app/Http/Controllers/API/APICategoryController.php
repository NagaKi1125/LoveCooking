<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as ResourcesCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class APICategoryController extends BaseController
{

    public function index(){
        $category = Category::all();
        return $this->sendResponse(ResourcesCategory::collection($category),'Category retrieved successfully');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'category' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category = Category::create($input);

        return $this->sendResponse(new ResourcesCategory($category), 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }

        return $this->sendResponse(new ResourcesCategory($category), 'Category retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $category= Category::find($id);
        $validator = Validator::make($input, [
            'category' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category->category = $input['category'];
        $category->save();

        return $this->sendResponse(new ResourcesCategory($category), 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();

        return $this->sendResponse([], 'Category deleted successfully.');
    }
}
