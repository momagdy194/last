<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(env('PAGINATION_COUNT'));
        return view('admin.categories.categories')->with([
            'categories' => $categories,
            'showLinks' => true
        ]);
    }

    private function CategoryNameExists($CategoryName){
        $category = Category::where(
            'name' , '=' , $CategoryName
        )->first();

        if (!is_null($category)) {
            Session::flash('message', 'Category (' . $CategoryName . ') already exists');
            return false;
        }
        return true;
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'category_image'=>'required',
            'image_direction'=>'required'
        ]);

        $Categoryname = $request->input('name');

        if (!$this->CategoryNameExists($Categoryname)) {
            return redirect()->back();
        }

        $category = new Category();
        $category->name = $Categoryname;
        $category->image_direction=$request->input('category_image');
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
                $path = $image->store('public');
            $category->image_url=$path;


        }


        $category->save();
        Session::flash('message', 'Category ' . $Categoryname . ' has been added');
        return redirect()->back();

    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);


        $categoryName = $request->input('name');
        if (!$this->CategoryNameExists($categoryName)) {
            return redirect()->back();
        }

        $category_id = intval($request->input('category_id'));

        $category = Category::find($category_id);
        $category->name = $categoryName;
        $category->save();

        Session::flash('message', ' Category ' . $category->name . ' has been Updated');
        return \redirect()->back();
    }

    public function search(Request $request)
    {
        $request->validate([
            'category_search' => 'required'
        ]);

        $searchTerm = $request->input('category_search');

        $categories = Category::where(

            'name',
            'LIKE',
            '%' . $searchTerm . '%'

        )->get();

        if (count($categories) > 0) {
            return view('admin.categories.categories')->with([
                'categories' => $categories,
                'showLinks' => false
            ]);
        }
        Session::flash('message', 'Nothing Found!');
        return redirect()->back();
    }

    public function delete(Request $request){

        if (is_null($request->input('category_id')) || empty($request->input('category_id'))) {
            dd($request->input('category_id'));
            Session::flash('message', 'Category ID Required');
            return \redirect()->back();

        }

        $id = $request->input('category_id');
        Category::destroy($id);
        Session::flash('message', 'Category has been deleted');
        return \redirect()->back();


    }

}
