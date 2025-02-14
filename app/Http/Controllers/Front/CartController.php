<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;


use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart){
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.cart', [
            'cart' => $this->cart,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1']
        ]);

        $product = Product::findOrFail($request->post('product_id'));

        $cart->add($product, $request->post('quantity', 1)); // استخدام 1 كقيمة افتراضية إذا لم يتم تقديم الكمية
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart,$id)
    {
        $request->validate([

            'quantity' => ['required','int','min:1']
        ]);


        $cart->update($id,$request->post('quantity'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, $id)
    {
        $cart->delete($id); // حذف العنصر من قاعدة البيانات
        return response()->json([
            'message' => 'Item deleted successfully!' // تأكد من كتابة الرسالة بشكل صحيح
        ]);
    }

}