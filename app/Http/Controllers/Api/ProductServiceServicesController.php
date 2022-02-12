<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceCollection;

class ProductServiceServicesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductService $productService)
    {
        $this->authorize('view', $productService);

        $search = $request->get('search', '');

        $services = $productService
            ->services()
            ->search($search)
            ->latest()
            ->paginate();

        return new ServiceCollection($services);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductService $productService)
    {
        $this->authorize('create', Service::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $service = $productService->services()->create($validated);

        return new ServiceResource($service);
    }
}
