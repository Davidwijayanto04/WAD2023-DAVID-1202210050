@extends('layoutUser')
@section('title', 'Tenant Menu')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Menu for {{ $tenant->name }}</h2>
        <div class="row">
            @forelse($menuItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="text-muted">Rp.{{ number_format($item->price) }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <form action="{{ route('user.order') }}" method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary">Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>No menu items found for this tenant.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
