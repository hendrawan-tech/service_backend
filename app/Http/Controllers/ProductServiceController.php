<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductServiceStoreRequest;
use App\Http\Requests\ProductServiceUpdateRequest;

class ProductServiceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ProductService::class);

        $search = $request->get('search', '');

        $productServices = ProductService::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.product_services.index',
            compact('productServices', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ProductService::class);

        $productServiceCategories = ProductServiceCategory::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.product_services.create',
            compact('productServiceCategories', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\ProductServiceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductServiceStoreRequest $request)
    {
        $this->authorize('create', ProductService::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $productService = ProductService::create($validated);

        return redirect()
            ->route('product-services.edit', $productService)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductService $productService)
    {
        $this->authorize('view', $productService);

        return view('app.product_services.show', compact('productService'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductService $productService)
    {
        $this->authorize('update', $productService);

        $productServiceCategories = ProductServiceCategory::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.product_services.edit',
            compact('productService', 'productServiceCategories', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\ProductServiceUpdateRequest $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProductServiceUpdateRequest $request,
        ProductService $productService
    ) {
        $this->authorize('update', $productService);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($productService->image) {
                Storage::delete($productService->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $productService->update($validated);

        return redirect()
            ->route('product-services.edit', $productService)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductService $productService)
    {
        $this->authorize('delete', $productService);

        if ($productService->image) {
            Storage::delete($productService->image);
        }

        $productService->delete();

        return redirect()
            ->route('product-services.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
