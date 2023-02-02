<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $slider;
    protected $category;
    protected $product;
    public function __construct(Slider $slider,Category $category,Product $product){
        $this->slider=$slider;
        $this->category=$category;
        $this->product=$product;
    }

    public function index(){
        $sliders=$this->slider->latest()->get();
        $categories=$this->category->where('parent_id',0)->get();
        $products=$this->product->latest()->take(6)->get();
        $productsRecommend=$this->product->latest('views_count','desc')->take(12)->get();
        $categoriesLimit=$this->category->where('parent_id',0)->take(3)->get();
        return view('home.home',compact('sliders','categories','products','productsRecommend','categoriesLimit'));
    }

}
