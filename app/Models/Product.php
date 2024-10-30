<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Product extends Model
{
    protected $guarded = [];
    use HasFactory;
    // في App\Models\Product
    public function store()
    {
        return $this->belongsTo(Store::class, "store_id", "id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
    // Global Scope to filter products by store_id of authenticated user
    protected static function boot()
    {
        parent::boot(); // Ensure the parent's boot method is called

        // Apply the global scope only if the user is authenticated
        static::addGlobalScope('store', function (Builder $builder) {
            if (Auth::check()) { // Check if user is logged in
                $user = Auth::user();
                if ($user && $user->store_id) {
                    // Filter products by the store_id of the authenticated user
                    $builder->where('store_id', '=', $user->store_id);
                }
            }
        });
    }
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag', // اسم الجدول الوسيط
            'product_id',  // العمود الذي يمثل المنتج
            'tag_id',
        );
    }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function getImageUrlAttribute()
    {
        // Check if image is not set or is empty
        if (!$this->image) {
            return asset('storage/default-image_0.jpeg');
        }

        // Check if the image URL starts with 'http' or 'https'
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            // return $this->image;
            return asset('storage/default-image_0.jpeg');
        }

        // Otherwise, return the image path from storage
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute(){
        if (!$this->compare_price) { // If there's no compare_price, return 0
            return 0;
        }
        return round( 100 - (100 * $this->price / $this->compare_price),1);
    }

}