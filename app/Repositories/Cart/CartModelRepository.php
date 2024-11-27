<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRepository implements CartRepository
{
    protected $items;
    public function __construct(){
        $this->items = collect ([]);
    }
    public function get(): Collection
    {
        if(!$this->items->count()){
      $this->items =Cart::with('product')
        ->where('cookie_id', '=', $this->getCookieId())
        ->get();
    }
    return $this->items;

    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::where('product_id', '=', $product->id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->first();

        if (!$item) {
            $cart = Cart::create([
                'cookie_id' => $this->getCookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $this->get()->push($cart);
            return $cart;
        } else {
            $item->increment('quantity', $quantity);
            return $item;
        }
    }

    public function update($id , $quantity)
    {
        Cart::where('id', '=', $id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete($id)
    {
        return Cart::where('id', '=', $id)
            ->where('cookie_id', '=', $this->getCookieId()) // تأكد من أن الـ cookie_id صحيح
            ->delete();
    }


    public function empty()
    {
        Cart::where('cookie_id', '=', $this->getCookieId())->delete();
    }

    public function total(): float
    {
        // return (float) Cart::where('cookie_id', '=', $this->getCookieId())
        //     ->join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')
        //     ->value('total') ?? 0.0;
       return $this->get()->sum(function($item){
            return $item->quantity * $item->product->price;
        });
    }

    public function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30*24*60);
        }
        return $cookie_id;
    }
}
