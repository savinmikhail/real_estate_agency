@extends('layouts.app')

@section('title', 'Basket')

@section('content')
    <h1>Корзина</h1>

    @if($basketItems->isEmpty())
        <p>Ваша корзина пуста</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($basketItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>${{ $item->product->price }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"><strong>Итого:</strong></td>
                <td>${{ $total }}</td>
            </tr>
            </tbody>
        </table>

        <form action="{{ route('createOrder') }}" method="POST">
            @csrf
            <button type="submit">Оформить заказ</button>
        </form>
    @endif
@endsection
