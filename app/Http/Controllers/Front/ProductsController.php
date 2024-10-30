<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product; // تأكد من استيراد النموذج
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        // قم بإضافة أي منطق تريده هنا
    }
    public function show(Product $product) {
        if ($product->status != 'active') {
            abort(404); // يعرض صفحة 404 إذا لم يكن المنتج نشطاً
        }

        return view('front.products.show', compact('product'));
    }

}