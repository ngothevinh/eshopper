<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index(){
        $sliders=Slider::latest()->get();
        $categoriesLimit=Category::where('parent_id',0)->take(3)->get();
        return view('error.404Error',compact('sliders','categoriesLimit'));
    }
}
