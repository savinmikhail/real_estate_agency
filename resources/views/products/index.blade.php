@extends('layouts.app')

@section('title', 'All Products')
@section('content')

    <h1>Каталог</h1>

    <table>
        <thead>
        <tr>
            <th>Название</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ $product->price }}</td>
                <td>
                    <form id="addToBasketForm_{{ $product->id }}" action="{{ route('addToBasket') }}" method="POST">
                        @csrf
                        <input type="number" id="quantity_{{ $product->id }}" name="quantity" value="1" min="1">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit">Добавить в корзину</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
