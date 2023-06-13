@extends('layouts.master')
@section('content')
<br>
    <h1>Order #{{ $orderId }}</h1>
    <table class="table responsive table-striped">
        <thead>
            <tr>
                <th scope="col">Item Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <th scope="row">{{ $item->title }}</th>
                    <td>{{ $item->sell_price }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                    <td>{{ $item->sell_price * $item->pivot->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2>= ₱{{ $orderTotal }}</h2>
@endsection