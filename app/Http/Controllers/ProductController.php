<?php

namespace App\Http\Controllers;

use App\Handlers\ProductHandler;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $handler = new ProductHandler();
        $handler->create($request->all());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     */
    public function update(Request $request, Product $product)
    {
        $handler = new ProductHandler($product);
        $handler->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $handler = new ProductHandler($product);
        $handler->delete();
    }
}
