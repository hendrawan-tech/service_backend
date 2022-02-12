<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
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
            ->paginate(5);

        return view(
            'app.category_products.index',
            compact('categoryProducts', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CategoryProduct::class);

        return view('app.category_products.create');
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

        return redirect()
            ->route('category-products.edit', $categoryProduct)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CategoryProduct $categoryProduct)
    {
        $this->authorize('view', $categoryProduct);

        return view('app.category_products.show', compact('categoryProduct'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CategoryProduct $categoryProduct)
    {
        $this->authorize('update', $categoryProduct);

        return view('app.category_products.edit', compact('categoryProduct'));
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

        return redirect()
            ->route('category-products.edit', $categoryProduct)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('category-products.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
