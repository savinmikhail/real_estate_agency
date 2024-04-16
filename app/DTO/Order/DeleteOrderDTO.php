<?php

namespace App\DTO\Order;

final readonly class DeleteOrderDTO
{
    public function __construct(
        public string $orderId,
    ) {
    }
}
