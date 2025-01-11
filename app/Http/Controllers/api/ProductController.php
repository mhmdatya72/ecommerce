<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $product = Product::with(['category:id,name', 'store:id,name'])
                      ->filter($request->query())
                      ->paginate();
                      return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric|gte:price',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
        ]);
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

          return new ProductResource($product);


    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            ' ' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'compare_price' => 'nullable|numeric|gte:price',
            'description' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'store_id' => 'sometimes|required|exists:stores,id',
        ]);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }

}