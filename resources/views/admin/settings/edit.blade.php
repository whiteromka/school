@php
    use App\Models\Setting;

    /** @var Setting $setting */
@endphp

@extends('layouts.admin')

@section('title', 'Edit setting')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Edit setting</h5>
            <form method="POST" action="{{ route('admin.settings.update', $setting) }}">
                @csrf
                @method('PUT')
                @include('admin.settings.form', ['$setting' => $setting])
            </form>
        </div>
    </div>

@endsection
