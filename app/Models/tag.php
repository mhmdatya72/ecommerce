<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $fillable = ['name','slug'] ;
    public $timestamps = false;
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_tag',  // اسم الجدول الوسيط
            'tag_id',       // عمود الوسم في الجدول الوسيط
            'product_id'    // عمود المنتج في الجدول الوسيط
        );
    }

}
