<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductServiceCategory;
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
            ->paginate(5);

        return view(
            'app.product_service_categories.index',
            compact('productServiceCategories', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ProductServiceCategory::class);

        return view('app.product_service_categories.create');
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

        return redirect()
            ->route('product-service-categories.edit', $productServiceCategory)
            ->withSuccess(__('crud.common.created'));
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

        return view(
            'app.product_service_categories.show',
            compact('productServiceCategory')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductServiceCategory $productServiceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        ProductServiceCategory $productServiceCategory
    ) {
        $this->authorize('update', $productServiceCategory);

        return view(
            'app.product_service_categories.edit',
            compact('productServiceCategory')
        );
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

        return redirect()
            ->route('product-service-categories.edit', $productServiceCategory)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('product-service-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
