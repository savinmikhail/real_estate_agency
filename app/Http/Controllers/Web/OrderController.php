<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteOrderRequest;
use App\Services\OrderService;
use Illuminate\Support\Facades\Redirect;

final class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function create()
    {
        $this->orderService->create();
        return Redirect::back();
    }

    public function index()
    {
        [$orders, $totalOfAllOrders] = $this->orderService->index();
        return view('orders.index', compact('orders', 'totalOfAllOrders'));
    }

    public function delete(DeleteOrderRequest $request)
    {
        $this->orderService->delete($request->toDto());
        return Redirect::back();
    }
}
