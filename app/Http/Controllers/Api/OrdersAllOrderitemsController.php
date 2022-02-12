<?php

namespace App\Http\Controllers\Api;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderitemsResource;
use App\Http\Resources\OrderitemsCollection;

class OrdersAllOrderitemsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Orders $orders)
    {
        $this->authorize('view', $orders);

        $search = $request->get('search', '');

        $allOrderitems = $orders
            ->allOrderitems()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderitemsCollection($allOrderitems);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Orders $orders)
    {
        $this->authorize('create', Orderitems::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $orderitems = $orders->allOrderitems()->create($validated);

        return new OrderitemsResource($orderitems);
    }
}
