@php
    use App\Models\Setting;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;

     /** @var LengthAwarePaginator $settings */
@endphp

@extends('layouts.admin')

@section('title', 'Setting')

@section('content')
    <h1>Settings</h1>

    <a href="{{ route('admin.settings.create') }}"
       class="btn btn-sm btn-success">
        Add
    </a>

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Description</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
                </thead>

                <tbody>
                @php
                    /** @var Setting $setting */
                @endphp
                @foreach($settings as $setting)
                    <tr>
                        <td>{{ $setting->id }}</td>
                        <td>{{ $setting->name }}</td>
                        <td>{{ $setting->type }}</td>
                        <td>{{ $setting->value }}</td>
                        <td>{{ $setting->description }}</td>
                        <td>
                            <div class="d-flex gap-1">

                                <a href="{{ route('admin.settings.show', $setting) }}"
                                   class="btn btn-sm btn-info">
                                    View
                                </a>

                                <a href="{{ route('admin.settings.edit', $setting) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.settings.destroy', $setting) }}"
                                      onsubmit="return confirm('Delete setting?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{ $settings->links() }}
@endsection
