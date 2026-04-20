@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<h1>Users</h1>

<div class="card">
    <div class="card-body p-0">

        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-light">
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Email</th>
                <th>Name</th>
                <th style="width: 120px;">Admin</th>
                <th style="width: 220px;">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getFullNameOrEmail() }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge bg-success">YES</span>
                        @else
                            <span class="badge bg-secondary">NO</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">

                            <a href="{{ route('admin.users.show', $user) }}"
                               class="btn btn-sm btn-info">
                                View
                            </a>

                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form method="POST"
                                  action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Delete user?')">
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

{{ $users->links() }}
@endsection
