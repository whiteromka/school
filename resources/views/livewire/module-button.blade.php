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
                <div class="sign-error js-cy-brackets" data-color="red" data-context="Требуется авторизация">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">
                        <path fill="red" d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z"/>
                    </svg>
                    <i>auth</i>
                </div>
            @endguest

            <button wire:click="toggle" class="btn btn-s">
                <span class="btn__content">Записаться бесплатно</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
        </div>
    @endif
</div>
