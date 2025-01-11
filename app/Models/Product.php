<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at','image'];
    protected $appends = ['image_url'];

    // Define relationship with Store model
    public function store()
    {
        return $this->belongsTo(Store::class, "store_id", "id");
    }

    // Define relationship with Category model
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
        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });

    }

    // Define relationship with Tag model
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag', // Name of the pivot table
            'product_id',  // Foreign key for the product
            'tag_id',      // Foreign key for the tag
        );
    }

    // Scope to filter active products
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    // Accessor to get the image URL
    public function getImageUrlAttribute()
    {
        // Check if image is not set or is empty
        if (!$this->image) {
            return asset('images/pexels-madebymath-90946.jpg');
        }

        // Check if the image URL starts with 'http' or 'https'
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            // return $this->image;
            return asset('images/pexels-madebymath-90946.jpg');
        }

        // Otherwise, return the image path from storage
        return asset('storage/' . $this->image);
    }

    // Accessor to get the sale percentage
    public function getSalePercentAttribute(){
        if (!$this->compare_price) { // If there's no compare_price, return 0
            return 0;
        }
        return round( 100 - (100 * $this->price / $this->compare_price),1);
    }
    public function scopeFilter(Builder $builder, $value)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag' => [],
            'status' => 'active',
        ], $value);

        $builder->when($options['store_id'], fn($query, $store_id) => $query->where('store_id', $store_id));
        $builder->when($options['category_id'], fn($query, $category_id) => $query->where('category_id', $category_id));
        $builder->when($options['tag'], fn($query, $tags) => $query->whereHas('tags', fn($query) => $query->whereIn('slug', $tags)));
        $builder->when($options['status'], fn($query, $status) => $query->where('status', $status));
    }

}
