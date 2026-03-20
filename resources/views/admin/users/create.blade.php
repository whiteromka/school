@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create User</h2>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
            ← Back to List
        </a>
    </div>

    <div class="card shadow-sm" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telegram" class="form-label">Telegram</label>
                    <input type="text" class="form-control @error('telegram') is-invalid @enderror" 
                           id="telegram" name="telegram" value="{{ old('telegram') }}">
                    @error('telegram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password *</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password *</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Create User</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
