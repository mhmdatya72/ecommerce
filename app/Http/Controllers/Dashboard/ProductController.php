<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // عرض قائمة المنتجات
    public function index()
    {
        // استبعاد الـ Global Scope للحصول على جميع المنتجات
        $products = Product::withoutGlobalScope("store")->with('category', 'store')->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }

    // عرض نموذج إنشاء منتج جديد
    public function create()
    {
        $stores = Store::all(); // الحصول على جميع المتاجر
        $categories = Category::all(); // الحصول على جميع الفئات
        return view("dashboard.products.create", compact("stores", "categories")); // تمرير المتاجر والفئات إلى العرض
    }

    // تخزين منتج جديد
    public function store(Request $request)
    {
        // دمج الاسم المراد تحويله إلى slug
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        // إعداد البيانات التي سيتم تخزينها
        $data = $request->except('image');

        // معالجة تحميل الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::slug($request->name) . '.' . $extension;
            $path = $image->storeAs('uploads', $fileName, 'public');
            $data['image'] = $path;
        }

        // إنشاء المنتج باستخدام البيانات
        $product = Product::create($data);

        return redirect()->route("dashboard.products.index")->with('success', 'Product Created');
    }

    // عرض تفاصيل المنتج
    public function show(Product $product)
    {
        // return view('dashboard.products.show', compact('product'));
    }

    // عرض نموذج تحرير منتج موجود
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $tags = $product->tags->pluck('name')->implode(','); // Get tags as a comma-separated string

        return view('dashboard.products.edit', compact('product', 'categories', 'tags'));
    }

    // تحديث منتج موجود
    public function update(Request $request, Product $product)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'tags' => 'nullable|json',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Exclude 'tags' and 'image' from the fields to be updated
        $data = $request->except(['tags', 'image']);

        // Check if an image file is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Store the new image
            $file = $request->file('image');
            $fileName = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $fileName, 'public');
            $data['image'] = $path;
        }

        // Update product data
        $product->update($data);

        // Process tags
        $tag_ids = [];
        $tags = json_decode($request->post('tags'), true) ?? [];

        foreach ($tags as $item) {
            $slug = Str::slug($item['value']);

            // Use firstOrCreate for streamlined tag retrieval/creation
            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['name' => $item['value']]
            );

            $tag_ids[] = $tag->id;
        }

        // Sync tags with the product in the 'product_tag' table
        $product->tags()->sync($tag_ids);

        // Redirect to the products index page with a success message
        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }

    // حذف منتج موجود
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // حذف الصورة من التخزين إذا كانت موجودة
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return redirect()->back()->with('success', 'Product deleted!');
    }
}
