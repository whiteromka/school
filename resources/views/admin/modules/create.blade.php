@extends('admin.layouts.app')

@section('title', 'Create Module')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create Module</h2>
        <a href="{{ route('admin.modules') }}" class="btn btn-secondary">
            ← Back to List
        </a>
    </div>

    <div class="card shadow-sm" style="max-width: 800px;">
        <div class="card-body">
            <form action="{{ route('admin.modules.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type *</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Back" {{ old('type') == 'Back' ? 'selected' : '' }}>Back</option>
                            <option value="Front" {{ old('type') == 'Front' ? 'selected' : '' }}>Front</option>
                            <option value="Eng" {{ old('type') == 'Eng' ? 'selected' : '' }}>Eng</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="number" class="form-control @error('number') is-invalid @enderror"
                               id="number" name="number" value="{{ old('number') }}">
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="level" class="form-label">Level *</label>
                        <input type="number" class="form-control @error('level') is-invalid @enderror"
                               id="level" name="level" value="{{ old('level', 1) }}" min="1" required>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="module_price" class="form-label">Module Price *</label>
                        <input type="number" class="form-control @error('module_price') is-invalid @enderror"
                               id="module_price" name="module_price" value="{{ old('module_price', 0) }}" min="0" required>
                        @error('module_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lesson_price" class="form-label">Lesson Price *</label>
                        <input type="number" class="form-control @error('lesson_price') is-invalid @enderror"
                               id="lesson_price" name="lesson_price" value="{{ old('lesson_price', 0) }}" min="0" required>
                        @error('lesson_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="count_lessons" class="form-label">Count Lessons *</label>
                        <input type="number" class="form-control @error('count_lessons') is-invalid @enderror"
                               id="count_lessons" name="count_lessons" value="{{ old('count_lessons', 12) }}" min="1" required>
                        @error('count_lessons')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control @error('duration') is-invalid @enderror"
                               id="duration" name="duration" value="{{ old('duration') }}" placeholder="e.g., 1 - 1.5 мес">
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author *</label>
                    <select class="form-select @error('author') is-invalid @enderror" id="author" name="author" required>
                        <option value="">Select Author</option>
                        <option value="Roman Belov" {{ old('author') == 'Roman Belov' ? 'selected' : '' }}>Roman Belov</option>
                        <option value="Iliah Udin" {{ old('author') == 'Iliah Udin' ? 'selected' : '' }}>Iliah Udin</option>
                    </select>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="techs" class="form-label">Technologies (comma separated)</label>
                    <input type="text" class="form-control @error('techs') is-invalid @enderror"
                           id="techs" name="techs" value="{{ old('techs', '') }}" placeholder="html, css, php, js">
                    <small class="text-muted">Enter technologies separated by commas</small>
                    @error('techs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="topics" class="form-label">Topics (one per line)</label>
                    <textarea class="form-control @error('topics') is-invalid @enderror"
                              id="topics" name="topics" rows="5">{{ old('topics', '') }}</textarea>
                    <small class="text-muted">Enter each topic on a new line</small>
                    @error('topics')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description2" class="form-label">Description 2</label>
                    <textarea class="form-control @error('description2') is-invalid @enderror"
                              id="description2" name="description2" rows="3">{{ old('description2') }}</textarea>
                    @error('description2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ old('active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Create Module</button>
                    <a href="{{ route('admin.modules') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#topics').on('blur', function() {
            var text = $(this).val();
            var lines = text.split('\n').filter(function(line) {
                return line.trim() !== '';
            });
            $(this).val(lines.join('\n'));
        });
    });
</script>
@endpush
