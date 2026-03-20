@extends('admin.layouts.app')

@section('title', 'Modules')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Modules</h2>
        <a href="{{ route('admin.modules.create') }}" class="btn btn-primary">
            + Add Module
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="modules-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Module Price</th>
                        <th>Lesson Price</th>
                        <th>Lessons</th>
                        <th>Techs</th>
                        <th>Active</th>
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
        $('#modules-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.modules.data") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'type', name: 'type' },
                { data: 'number', name: 'number' },
                { data: 'name', name: 'name' },
                { data: 'level', name: 'level' },
                { data: 'module_price', name: 'module_price' },
                { data: 'lesson_price', name: 'lesson_price' },
                { data: 'count_lessons', name: 'count_lessons' },
                { data: 'techs', name: 'techs', orderable: false, searchable: false },
                { data: 'active', name: 'active' },
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
