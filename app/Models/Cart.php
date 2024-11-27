<?php

namespace App\Models;

use Illuminate\Support\Str;
use GuzzleHttp\Promise\Create;
use App\Observers\CartObserver;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cart extends Model
{
    public $fillable =[
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'option',
    ];

    protected static function booted()
    {
        static::observe(CartObserver::class);



        // If you want to set UUIDs for Cart IDs, uncomment the following code:
        // static::creating(function (Cart $cart) {
        //     $cart->id = Str::uuid();
        // });
    }


    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'anonymous',
        ]);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    use HasFactory;
}