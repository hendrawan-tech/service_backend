<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductServiceResource;
use App\Http\Resources\ProductServiceCollection;
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
            ->paginate();

        return new ProductServiceCollection($productServices);
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

        return new ProductServiceResource($productService);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductService $productService)
    {
        $this->authorize('view', $productService);

        return new ProductServiceResource($productService);
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

        return new ProductServiceResource($productService);
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

        return response()->noContent();
    }
}
