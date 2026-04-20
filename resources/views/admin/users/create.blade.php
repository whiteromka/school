@extends('layouts.admin')

@section('title', 'Create user')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Create user</h5>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                @include('admin.users.form')
            </form>
        </div>
    </div>

@endsection
