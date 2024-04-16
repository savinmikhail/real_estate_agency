<?php

namespace App\Http\Requests;

use App\DTO\Order\DeleteOrderDTO;
use Illuminate\Foundation\Http\FormRequest;

final class DeleteOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'orderId' => [
                'required',
                'exists:orders,id',
            ],
        ];
    }

    public function toDto(): DeleteOrderDTO
    {
        $data = $this->validated();
        return new DeleteOrderDTO(
            orderId:  $data['orderId'],
        );
    }
}
