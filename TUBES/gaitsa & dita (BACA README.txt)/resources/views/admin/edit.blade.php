@extends('layoutAdmin')
@section('title', 'Edit User')
@section('content')
    <div class="container">
        <h2>Edit User</h2>
        <form method="POST" action="{{ route('admin.update', ['id' => $user->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
