@php
    use App\Models\Setting;

    /** @var Setting $setting */
@endphp

<div class="row">

    <div class="col-md-6">

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $setting->name ?? '') }}">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- TYPE --}}
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select
                   name="type"
                   class="form-control @error('type') is-invalid @enderror"
                   value="{{ old('type', $setting->type ?? '') }}"
            >
                @foreach(Setting::getTypes() as $key => $type)
                    <option value="{{ $key }}">{{ $type }}</option>
                @endforeach

            </select>

            @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Value --}}
        <div class="mb-3">
            <label class="form-label">Value</label>
            <input type="text"
                   name="value"
                   class="form-control @error('value') is-invalid @enderror"
                   value="{{ old('value', $setting->value ?? '') }}">

            @error('value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text"
                   name="description"
                   class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description', $setting->description ?? '') }}">

            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Save
            </button>

            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </div>

</div>
