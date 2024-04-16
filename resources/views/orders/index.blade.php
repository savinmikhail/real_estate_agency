@extends('layouts.app')

@section('title', 'All Orders')

@section('content')
    <h1>Мои заказы</h1>

    @if($orders->isEmpty())
        <p>Пока нет ни одного заказа</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Дата заказа</th>
                <th>Продукты</th>
                <th>Стоимость</th>
                <th>Действия</th> <!-- New column for delete button -->
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->product_names }}</td>
                    <td>${{ $order->total_price }}</td>
                    <td>
                        <form action="{{ route('orders.delete', ['orderId' =>$order->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <strong>Сумма всех заказов:</strong> ${{ $totalOfAllOrders }}
        </div>
        {{ $orders->links() }}
    @endif
@endsection
