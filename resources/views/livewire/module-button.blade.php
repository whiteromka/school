<div>
    @if($isUserJoined)
        <div class="btn btn-s btn--success c-d mb-2">
            <span class="btn__content">Вы записаны</span>
            <span class="btn__glitch_"></span>
            <span class="btn__label_">r25</span>
        </div>

        <button
            wire:click="toggle"
            class="btn btn-s btn--secondary mb-2"
        >
            <span class="btn__content">Выписаться</span>
            <span class="btn__glitch"></span>
            <span class="btn__label">r25</span>
        </button>
    @else
        <div class="d-flex align-items-center justify-content-end">
            @guest
                @include('components.error-sign', ['text' => 'auth', 'context' => 'Требуется авторизация'])
            @endguest

            <button wire:click="toggle" class="btn btn-s">
                <span class="btn__content">Записаться бесплатно</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
        </div>
    @endif
</div>
