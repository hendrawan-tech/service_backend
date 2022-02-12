<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductServiceCategory;
use App\Http\Resources\ProductServiceCategoryResource;
use App\Http\Resources\ProductServiceCategoryCollection;
use App\Http\Requests\ProductServiceCategoryStoreRequest;
use App\Http\Requests\ProductServiceCategoryUpdateRequest;

class ProductServiceCategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ProductServiceCategory::class);

        $search = $request->get('search', '');

        $productServiceCategories = ProductServiceCategory::search($search)
            ->latest()
            ->paginate();

        return new ProductServiceCategoryCollection($productServiceCategories);
    }

    /**
     * @param \App\Http\Requests\ProductServiceCategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductServiceCategoryStoreRequest $request)
    {
        $this->authorize('create', ProductServiceCategory::class);

        $validated = $request->validated();

        $productServiceCategory = ProductServiceCategory::create($validated);

        return new ProductServiceCategoryResource($productServiceCategory);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductServiceCategory $productServiceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        ProductServiceCategory $productServiceCategory
    ) {
        $this->authorize('view', $productServiceCategory);

        return new ProductServiceCategoryResource($productServiceCategory);
    }

    /**
     * @param \App\Http\Requests\ProductServiceCategoryUpdateRequest $request
     * @param \App\Models\ProductServiceCategory $productServiceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProductServiceCategoryUpdateRequest $request,
        ProductServiceCategory $productServiceCategory
    ) {
        $this->authorize('update', $productServiceCategory);

        $validated = $request->validated();

        $productServiceCategory->update($validated);

        return new ProductServiceCategoryResource($productServiceCategory);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductServiceCategory $productServiceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ProductServiceCategory $productServiceCategory
    ) {
        $this->authorize('delete', $productServiceCategory);

        $productServiceCategory->delete();

        return response()->noContent();
    }
}
