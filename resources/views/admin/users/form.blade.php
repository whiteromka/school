<div class="row">

    <div class="col-md-6">

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name ?? '') }}">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Last name --}}
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text"
                   name="last_name"
                   class="form-control @error('last_name') is-invalid @enderror"
                   value="{{ old('last_name', $user->last_name ?? '') }}">

            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email ?? '') }}">

            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label class="form-label">
                Password
                @isset($user)
                    <small class="text-muted">(leave empty to keep current)</small>
                @endisset
            </label>

            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror">

            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Admin checkbox --}}
        <div class="form-check mb-3">
            <input type="checkbox"
                   name="is_admin"
                   value="1"
                   class="form-check-input"
                   id="is_admin"
                {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>

            <label class="form-check-label" for="is_admin">
                Admin
            </label>
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Save
            </button>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </div>

</div>
