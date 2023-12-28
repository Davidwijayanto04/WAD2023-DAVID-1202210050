@extends('layoutUser')
@section('title', 'Order Status')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Your Orders</h2>
        @if($orders->isEmpty())
            <div class="alert alert-info">No orders found.</div>
        @else
            <div class="list-group">
            @foreach($orders as $order)
                <div class="list-group-item">
                    <h5 class="mb-1">Order: {{ $order->food_name ?? 'Menu item not found' }}</h5>
                    <p class="mb-1">Status: {{ $order->status }}</p>
                </div>
            @endforeach
            </div>
        @endif
    </div>
@endsection
