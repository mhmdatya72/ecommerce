<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $categories = Category::filter(request()
    ->query())
    ->paginate(5);
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
    public function store(CategoryRequest $request)
    {
        // دمج الاسم المراد تحويله إلى slug
        $request->merge([
            'slug' => Str::slug($request->name), // تأكد من أن Str بحروف كبيرة
        ]);

        // استثناء الصورة من البيانات التي سيتم حفظها
        $data = $request->except('image');

        // إذا كانت هناك صورة مرفوعة
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // الحصول على الامتداد الخاص بالملف
            $extension = $file->getClientOriginalExtension();

            // اسم الملف بناءً على اسم الفئة
            $fileName = Str::slug($request->name) . '.' . $extension;

            // تخزين الصورة باسم الفئة مع الامتداد الصحيح
            $path = $file->storeAs('uploads', $fileName, 'public');

            // حفظ مسار الصورة في قاعدة البيانات
            $data['image'] = $path;
        }

        // إنشاء الفئة في قاعدة البيانات
        $category = Category::create($data);

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
    public function update(CategoryRequest $request, Category $category)
    {

        // استخدام التحقق من صحة المدخلات
        // $request->validate(Category::rules(),[
        //     'unique' =>'This is name already  exists',
        //     'required'=>'This field :attribute is required'
        // ]);
              // دمج الـ slug الجديد مع البيانات الواردة
              $request->merge([
                'slug' => Str::slug($request->name), // تأكد من أن Str بحروف كبيرة
            ]);

        // استثناء الصورة من البيانات التي سيتم تحديثها
        $data = $request->except('image');

        // إذا كانت هناك صورة مرفوعة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $file = $request->file('image');

            // الحصول على الامتداد الخاص بالملف
            $extension = $file->getClientOriginalExtension();

            // اسم الملف بناءً على اسم الفئة
            $fileName = Str::slug($request->name) . '.' . $extension;

            // تخزين الصورة باسم الفئة مع الامتداد الصحيح
            $path = $file->storeAs('uploads', $fileName, 'public');

            // حفظ مسار الصورة في قاعدة البيانات
            $data['image'] = $path;
        }


        // تحديث الفئة في قاعدة البيانات
        $category->update($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $category = Category::findOrFail($id); // تأكد من وجود الفئة
         $category->delete(); // استخدم delete بدلاً من destroy للتأكد من أن الفئة موجودة
    // if($category->image){
    //     Storage::disk('public')->delete($category->image);
    // }
         // Category::destroy($id);
    return redirect()->back()->with('success', 'Category deleted!');
    }

    public function trash(){
        $categories = Category::onlyTrashed()->paginate('5');
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('success', 'Category restored successfully.');
    }

    public function forceDelete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if($category->image){
            Storage::disk('')->delete($category->image);
        }
        return redirect()->back()->with('success','Category deleted forever! ');
    }
}
