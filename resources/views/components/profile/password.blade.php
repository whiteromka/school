@php
    use App\Models\User;
@endphp

<div class="data-panel" data-panel-id="password">
    @include('components.profile._profile-data-head', ['name' => 'Безопасность'])
    <div class="data-panel__body data-stream">
        <div class="d-flex justify-content-end">
            <a href="{{ route('profile.update-password-view')  }}" class="btn btn-s btn--secondary">
                <span class="btn__content">Сменить пароль</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </a>
        </div>
    </div>
</div>
