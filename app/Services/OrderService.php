<?php

namespace App\Services;

use App\DTO\Order\DeleteOrderDTO;
use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

final readonly class OrderService
{
    public function create(): void
    {
        $basket = Basket::query()->where('user_id', auth()->id())->first();

        if (!$basket) {
            throw new \Exception('basket not found');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
        ]);
        foreach ($basket->basketProducts as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }
        $basket->delete();
        Session::flash('success', 'Order created!');
    }

    public function index(): array
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return [$orders, $this->getTotalOfAllOrders()];
    }

    private function getTotalOfAllOrders(): string
    {
        $totalOfAllOrders = DB::table('orders')
            ->select(
                DB::raw(
                    'SUM((SELECT SUM(op.quantity * p.price) FROM order_products AS op JOIN products AS p ON op.product_id = p.id WHERE op.order_id = orders.id)) AS total_price'
                )
            )
            ->value('total_price');
        return number_format($totalOfAllOrders, 2);
    }

    public function delete(DeleteOrderDTO $dto): void
    {
        Order::query()->where('id', $dto->orderId)->delete();
        Session::flash('success', 'Order deleted!');
    }
}
