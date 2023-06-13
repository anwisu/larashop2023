@extends('layouts.master')
@section('content')
<br>
    {{-- <h1>Order #{{ $orderId }}</h1>
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
    <h2>= ₱{{ $orderTotal }}</h2> --}}

    <body class="bg-red-100">
        <div class="container">
            <div class="space-y-4 mb-6">
                <h1 class="text-4xl fw-800">Order #{{ $orderId }}</h1>
                <p>The estimated delivery time for your order is 6:10 PM - 6:20 PM. Track your order on the Larashop website.</p>
            </div>
            <div class="card border-info mb-3">
                <br>
                <h3 class="text-center">Receipt from Larashop</h3>
                <p class="text-center text-muted">Receipt #ABCD-EFGH</p>
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
                        <tr>
                            <td>Amount paid:</td>
                            <td></td>
                            <td></td>
                            <td><strong>${{ $orderTotal }}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <hr class="my-6">
                <p>If you have any questions, contact us at <a href="#">larashop@example.com</a>.</p>
                <br>
            </div>
        </div>
    </body>
@endsection