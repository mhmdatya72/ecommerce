<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    // protected $fillables = [
    //     'name','parent_id','description','image','status','slug',
    // ] ;
    protected $guarded = [];
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        // تصفية الفئات حسب الاسم
        if (!empty($filter['name'])) {
            $builder->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        // تصفية الفئات حسب الحالة
        if (!empty($filter['status'])) {
            $builder->where('status', $filter['status']);
        }
    }

    public static function rules($id = 0){
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories','name')->ignore($id),
                // function($attribute,$value, $fails){
                //     if($value == 'laravel'){
                //         $fails('This name  is forbidden!');

                // }
                // }
                new Filter(),

            ],
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // تأكد من وجود صورة بحجم معقول
            'status' => 'required|in:active,archived',
        ];
    }
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
