<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductImageCollection;
use App\Http\Requests\ProductImageStoreRequest;
use App\Http\Requests\ProductImageUpdateRequest;

class ProductImageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ProductImage::class);

        $search = $request->get('search', '');

        $productImages = ProductImage::search($search)
            ->latest()
            ->paginate();

        return new ProductImageCollection($productImages);
    }

    /**
     * @param \App\Http\Requests\ProductImageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductImageStoreRequest $request)
    {
        $this->authorize('create', ProductImage::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $productImage = ProductImage::create($validated);

        return new ProductImageResource($productImage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductImage $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductImage $productImage)
    {
        $this->authorize('view', $productImage);

        return new ProductImageResource($productImage);
    }

    /**
     * @param \App\Http\Requests\ProductImageUpdateRequest $request
     * @param \App\Models\ProductImage $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProductImageUpdateRequest $request,
        ProductImage $productImage
    ) {
        $this->authorize('update', $productImage);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($productImage->image) {
                Storage::delete($productImage->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $productImage->update($validated);

        return new ProductImageResource($productImage);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductImage $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductImage $productImage)
    {
        $this->authorize('delete', $productImage);

        if ($productImage->image) {
            Storage::delete($productImage->image);
        }

        $productImage->delete();

        return response()->noContent();
    }
}
