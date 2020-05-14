<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])->paginate(env('PAGINATION_COUNT'));

        $currency_code = env('CURRENCY_CODE', "$");

        return view('admin.products.products')->with([
            'products' => $products,
            'currency_code' => $currency_code
        ]);
    }

    public function newproduct($id = null)
    {
        $product = null;
        if (!is_null($id)) {
            $product = Product::with([
                'hasUnit', 'category','images'
            ])->find($id);
        }

        $units = Unit::all();
        $categories = Category::all();

        return view('admin.products.new-product')->with([
            'product' => $product,
            'units' => $units,
            'categories' => $categories,
        ]);
    }

    private function writeProduct(Request $request , Product $product , $update = false)
    {
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->unit = intval($request->input('unit'));
        $product->price = doubleval($request->input('price'));
        $product->total = doubleval($request->input('total'));
        $product->category_id = intval($request->input('category_id'));
        $product->discount = doubleval($request->input('discount'));

        if ($request->has('options')) {
            $optionArray = [];

            $options = array_unique($request->input('options'));  //get one option of the list

            foreach ($options as  $option) {

                $actualOptions = $request->input($option);

                $optionArray[$option] = [];

                foreach ($actualOptions as  $actualOption) {

                    array_push($optionArray[$option], $actualOption);
                }
            }

            $product->options = json_encode($optionArray);
        }

        $product->save();
        if ($request->hasFile('product_images')) {
            $images = $request->file('product_images');
            foreach ($images as $image) {
                $path = $image->store('public');
                $image = new Image();
                $image->url = $path;
                $image->product_id = $product->id;
                $image->save();
            }
        }
        return $product;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'category_id' => 'required',
        ]);

        $product = new Product();

        $this->writeProduct($request , $product);

        Session::flash('message', 'Product has been Added');
        return redirect(route('products'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'category_id' => 'required',
        ]);

        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        $this->writeProduct( $request , $product,true );

        Session::flash('message', 'Product has been Updated');
        return back();
    }

    
    public function deleteImage(Request $request)
    {
            $imageID = $request->input('image_id');
            Image::destroy($imageID);
    }
}
