@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            + Add User
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Telegram</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.users.data") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'telegram', name: 'telegram' },
                { data: 'created_at', name: 'created_at' },
                { 
                    data: 'actions', 
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [[0, 'desc']]
        });
    });
</script>
@endpush
