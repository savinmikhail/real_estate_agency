<?php

namespace App\DTO\Basket;

final readonly class AddProductDTO
{
    public function __construct(
        public int $productId,
        public int $quantity,
    ) {
    }
}
