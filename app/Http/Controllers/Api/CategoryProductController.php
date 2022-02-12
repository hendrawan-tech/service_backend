<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryProductResource;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Requests\CategoryProductStoreRequest;
use App\Http\Requests\CategoryProductUpdateRequest;

class CategoryProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CategoryProduct::class);

        $search = $request->get('search', '');

        $categoryProducts = CategoryProduct::search($search)
            ->latest()
            ->paginate();

        return new CategoryProductCollection($categoryProducts);
    }

    /**
     * @param \App\Http\Requests\CategoryProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryProductStoreRequest $request)
    {
        $this->authorize('create', CategoryProduct::class);

        $validated = $request->validated();

        $categoryProduct = CategoryProduct::create($validated);

        return new CategoryProductResource($categoryProduct);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CategoryProduct $categoryProduct)
    {
        $this->authorize('view', $categoryProduct);

        return new CategoryProductResource($categoryProduct);
    }

    /**
     * @param \App\Http\Requests\CategoryProductUpdateRequest $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(
        CategoryProductUpdateRequest $request,
        CategoryProduct $categoryProduct
    ) {
        $this->authorize('update', $categoryProduct);

        $validated = $request->validated();

        $categoryProduct->update($validated);

        return new CategoryProductResource($categoryProduct);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CategoryProduct $categoryProduct)
    {
        $this->authorize('delete', $categoryProduct);

        $categoryProduct->delete();

        return response()->noContent();
    }
}
