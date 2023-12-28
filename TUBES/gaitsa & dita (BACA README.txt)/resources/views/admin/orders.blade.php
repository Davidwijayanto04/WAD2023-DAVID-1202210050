@extends('layoutAdmin')
@section('title', 'Admin Orders')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">All Orders</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="list-group">
            @forelse($orders as $order)
                <div class="list-group-item">
                    <h5 class="mb-3">Order ID: {{ $order->id }}</h5>
                    <p><strong>User:</strong> {{ $order->user->name ?? 'User not found' }}</p>
                    <p><strong>Food Name:</strong> {{ $order->food_name }}</p>
                    <p><strong>Current Status:</strong> {{ $order->status }}</p>

                    <form method="POST" action="{{ route('admin.order.update', ['id' => $order->id]) }}" class="d-inline">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status-{{ $order->id }}">Update Status:</label>
                            <select id="status-{{ $order->id }}" name="status" class="form-control">
                                <option value="In process" {{ $order->status == 'In process' ? 'selected' : '' }}>In process</option>
                                <option value="On the way" {{ $order->status == 'On the way' ? 'selected' : '' }}>On the way</option>
                                <option value="Food Arrived" {{ $order->status == 'Food Arrived' ? 'selected' : '' }}>Food Arrived</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>

                    <form method="POST" action="{{ route('admin.order.cancel', ['id' => $order->id]) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger ml-2">Cancel Order</button>
                    </form>
                </div>
            @empty
                <div class="list-group-item">
                    <p>No orders found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
