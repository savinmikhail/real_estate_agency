<?php

namespace App\Http\Requests;

use App\DTO\Basket\AddProductDTO;
use Illuminate\Foundation\Http\FormRequest;

final class BasketAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'exists:products,id',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function toDto(): AddProductDTO
    {
        $data = $this->validated();
        return new AddProductDTO(
            productId:  $data['product_id'],
            quantity:   $data['quantity'],
        );
    }
}
