<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductServiceCategory;
use App\Http\Resources\ProductServiceResource;
use App\Http\Resources\ProductServiceCollection;

class ProductServiceCategoryProductServicesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductServiceCategory $productServiceCategory
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        ProductServiceCategory $productServiceCategory
    ) {
        $this->authorize('view', $productServiceCategory);

        $search = $request->get('search', '');

        $productServices = $productServiceCategory
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductServiceCollection($productServices);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductServiceCategory $productServiceCategory
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        ProductServiceCategory $productServiceCategory
    ) {
        $this->authorize('create', ProductService::class);

        $validated = $request->validate([
            'code' => ['required', 'max:8', 'string'],
            'name' => ['required', 'max:100', 'string'],
            'brand' => ['required', 'max:30', 'string'],
            'condition' => ['required', 'max:255', 'string'],
            'attribute' => ['required', 'max:255', 'string'],
            'problem' => ['required', 'max:255', 'string'],
            'specification' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'status' => ['required', 'in:{IMPLODED_OPTIONS}'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $productService = $productServiceCategory
            ->products()
            ->create($validated);

        return new ProductServiceResource($productService);
    }
}
