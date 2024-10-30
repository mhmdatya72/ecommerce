<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];
    public function product(){
        return $this->hasMany(Product::class,"product_id","id");
    }
    use HasFactory;
}