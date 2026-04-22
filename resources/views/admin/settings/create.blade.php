@php
    use App\Models\Setting;

    /** @var Setting $setting */
@endphp
@extends('layouts.admin')

@section('title', 'Create setting')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Create setting</h5>
            <form method="POST" action="{{ route('admin.settings.store') }}">
                @csrf
                @include('admin.settings.form')
            </form>
        </div>
    </div>

@endsection
