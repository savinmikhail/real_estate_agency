<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = false;
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getProductNamesAttribute(): string
    {
        return $this->orderProducts->map(static function (OrderProduct $orderProduct): string {
            return $orderProduct->product->name;
        })->implode(', ');
    }

    public function getTotalPriceAttribute()
    {
        return $this->orderProducts->sum(static function (OrderProduct $orderProduct) {
            return $orderProduct->product->price * $orderProduct->quantity;
        });
    }

}
