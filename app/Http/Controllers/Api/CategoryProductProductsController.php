<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class CategoryProductProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CategoryProduct $categoryProduct)
    {
        $this->authorize('view', $categoryProduct);

        $search = $request->get('search', '');

        $products = $categoryProduct
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryProduct $categoryProduct)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'price' => ['required', 'numeric'],
        ]);

        $product = $categoryProduct->products()->create($validated);

        return new ProductResource($product);
    }
}
