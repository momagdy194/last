<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        // $category = Category::all();
        // return new  CategoryResource($category);



        return CategoryResource::collection(Category::all());
    }

    public function show($id)
    {

        return new CategoryResource(Category::find($id));
    }

    public function products($id)
    {

        $category = Category::findOrFail($id);
        return ProductResource::collection($category->products()->paginate());

    }

}
