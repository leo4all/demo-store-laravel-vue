<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $products = Product::paginate(10);
        $response = [
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem()
            ],
            'data' => $products
        ];
        return response()->json($products);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'department' => $request->department,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => (bool) $product,
            'data'   => $product,
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        return response()->json($product,200);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name', 'description', 'amount', 'department','status'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        $status = $product->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
