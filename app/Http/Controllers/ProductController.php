<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Product retrieve function
     *
     * @return void
     */
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    /**
     * Product store function
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
     * Product show function
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        return response()->json($product,200);
    }

    /**
     * Product update function
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {

        $fields = ['name', 'description', 'amount', 'department','status'];

        if(!\Auth::user()->is_admin){
            $fields = ['amount','status'];
        }


        $status = $product->update(
            $request->only($fields)
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    /**
     * Product delete function
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
