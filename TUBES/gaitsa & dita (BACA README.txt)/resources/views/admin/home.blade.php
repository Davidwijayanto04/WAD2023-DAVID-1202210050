@extends('layoutAdmin')
@section('title', 'Admin Home Page')

@section('content')
    <div class="container">
        @auth
        <h1>Selamat datang {{ auth()->user()->name }}!</h1>
        @endauth
        <h2>List akun terdaftar</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('admin.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.delete', ['id' => $user->id]) }}" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
