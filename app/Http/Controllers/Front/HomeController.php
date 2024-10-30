<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $product = Product::with('Category')->active()->latest()->limit(8)->get();
        return view('front.home', compact('product'));
    }
}