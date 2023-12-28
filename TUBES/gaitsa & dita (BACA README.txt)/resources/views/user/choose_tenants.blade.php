@extends('layoutUser')
@section('title', 'Choose Tenant')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Select a Food Tenant</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            @foreach($tenants as $tenant)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tenant->name }}</h5>
                            <p class="card-text">{{ $tenant->description }}</p>
                            <a href="{{ route('user.tenant.menu', ['tenantId' => $tenant->id]) }}" class="btn btn-primary">View Menu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>  
@endsection
