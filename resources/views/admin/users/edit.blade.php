@extends('layouts.admin')

@section('title', 'Edit user')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Edit user</h5>
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')
                @include('admin.users.form', ['user' => $user])
            </form>
        </div>
    </div>

@endsection
