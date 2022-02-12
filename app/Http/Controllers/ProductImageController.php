<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            ->paginate(5);

        return view(
            'app.product_images.index',
            compact('productImages', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ProductImage::class);

        $products = Product::pluck('name', 'id');

        return view('app.product_images.create', compact('products'));
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

        return redirect()
            ->route('product-images.edit', $productImage)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductImage $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductImage $productImage)
    {
        $this->authorize('view', $productImage);

        return view('app.product_images.show', compact('productImage'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductImage $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductImage $productImage)
    {
        $this->authorize('update', $productImage);

        $products = Product::pluck('name', 'id');

        return view(
            'app.product_images.edit',
            compact('productImage', 'products')
        );
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

        return redirect()
            ->route('product-images.edit', $productImage)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('product-images.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
