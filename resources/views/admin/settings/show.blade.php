@php
    use App\Models\Setting;

    /** @var Setting $setting */
@endphp

@extends('layouts.admin')

@section('title', 'Setting #' . $setting->id)

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                    Setting #{{ $setting->id }}
                </h5>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary btn-sm">
                        Back
                    </a>
                </div>
            </div>

            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 200px;">ID</th>
                    <td>{{ $setting->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $setting->name }}</td>
                </tr>

                <tr>
                    <th>Type</th>
                    <td>{{ $setting->type }}</td>
                </tr>

                <tr>
                    <th>Value</th>
                    <td>{{ $setting->value }}</td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{ $setting->description }}</td>
                </tr>

                <tr>
                    <th>Created</th>
                    <td>{{ $setting->created_at }}</td>
                </tr>

                <tr>
                    <th>Updated</th>
                    <td>{{ $setting->updated_at }}</td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
