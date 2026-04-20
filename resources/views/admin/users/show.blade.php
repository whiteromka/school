@extends('layouts.admin')

@section('title', 'User #' . $user->id)

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                    User #{{ $user->id }}
                </h5>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                        Back
                    </a>
                </div>
            </div>

            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 200px;">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $user->getFullNameOrEmail() }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $user->phone ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Telegram</th>
                    <td>
                        @if($user->telegram)
                            {{ '@' . ltrim($user->telegram, '@') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Username</th>
                    <td>{{ $user->username ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Admin</th>
                    <td>
                        @if($user->is_admin)
                            <span class="badge bg-success">YES</span>
                        @else
                            <span class="badge bg-secondary">NO</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Email verified</th>
                    <td>
                        {{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i') : 'No' }}
                    </td>
                </tr>

                <tr>
                    <th>Created</th>
                    <td>{{ $user->created_at }}</td>
                </tr>

                <tr>
                    <th>Updated</th>
                    <td>{{ $user->updated_at }}</td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
