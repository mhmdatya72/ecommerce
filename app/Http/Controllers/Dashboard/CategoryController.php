<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent = Category::all();
        return view('dashboard.categories.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name), // تأكد من أن Str بحروف كبيرة
        ]);

        // استخدام التحقق من صحة المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // تأكد من وجود صورة بحجم معقول
            'status' => 'required|in:active,archived', // تأكد من تحديد حالة صحيحة
        ]);

        $category = Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created');
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id)
    {
        // يمكنك إضافة منطق هنا إذا كنت بحاجة إلى عرض تفاصيل الفئة
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'This category not found');
        }

        $parent = Category::where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                      ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,archived',
        ]);

        $category = Category::findOrFail($id); // استخدم findOrFail لتفادي الأخطاء
        $category->update($request->all()); // هذا سيمكنك من تحديث جميع الحقول تلقائيًا

        return redirect()->route('dashboard.categories.index')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id); // تأكد من وجود الفئة
        $category->delete(); // استخدم delete بدلاً من destroy للتأكد من أن الفئة موجودة
        return redirect()->back()->with('success', 'Category deleted');
    }
}