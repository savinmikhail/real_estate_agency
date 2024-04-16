<?php

namespace App\Services;

use App\DTO\Basket\AddProductDTO;
use App\Models\Basket;
use App\Models\BasketProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

final readonly class BasketService
{
    public function add(AddProductDTO $dto): void
    {
        $basketId = Basket::query()
            ->where('user_id', auth()->id())
            ->value('id');

        if (!$basketId) {
            $basketId = Basket::query()->create([
                'user_id' => auth()->id(),
            ])->id;
        }
        $item = BasketProduct::query()
            ->where('product_id', $dto->productId)
            ->where('basket_id', $basketId)
            ->first();

        if ($item === null) {
            BasketProduct::create([
                'product_id' => $dto->productId,
                'basket_id' => $basketId,
                'quantity' => $dto->quantity,
            ]);
            Session::flash('success', 'Product added to basket successfully');
        } else {
            $item->update(['quantity' => $dto->quantity]);
            Session::flash('success', 'Product quantity updated in basket');
        }
    }

    public function show()
    {
        $basket = Basket::query()->where('user_id', auth()->id())->first();

        if (!$basket) {
            $basket = Basket::query()->create([
                'user_id' => auth()->id(),
            ]);
        }

        /** @var Collection $basketItems */
        $basketItems = $basket->basketProducts;
        $total = $basketItems->sum(static function (BasketProduct $item): float {
            return $item->product->price * $item->quantity;
        });
        return [$basketItems, $total];
    }
}
