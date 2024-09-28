<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    // protected $fillables = [
    //     'name','parent_id','description','image','status','slug',
    // ] ;
    protected $guarded = [];
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
    use HasFactory;
}