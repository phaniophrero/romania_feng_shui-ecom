<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        //In Ascending Order
        // $productsAll = Product::get();

        //In Descending Order
        // $productsAll = Product::orderBy('id','DESC')->where('status', 1)->get();

        //In Random Order
        $productsAll = Product::inRandomOrder()->where('status', 1)->where('feature_item', 1)->paginate(6);

        //Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        // $categories = json_decode(json_encode($categories));
        // echo "<pre>"; print_r($categories); die;)

        $banners = Banner::where('status', '1')->get();

        // Meta tags
        $meta_title = "Romania Feng Shui";
        $meta_description = "Magazin online Feng Shui";
        $meta_keywords = "romania feng shui, marian golea, anca dimancea, magazin feng shui,prosperitate, succes, sanatate, iubire, paht chee, lillian too, metafizica chineza,bazi, amulete feng shui, feng shui, feng shui online, consultatii feng shui, charturi feng shui, cursuri feng shui";

        return view('index',compact('productsAll', 'categories', 'banners', 'meta_title', 'meta_description', 'meta_keywords'));
    }
}
