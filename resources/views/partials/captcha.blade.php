<?php
    $captcha = $captcha ?? \App\Services\CaptchaService::generate();
    $error = $error ?? ($errors?->has('captcha') ? $errors?->first('captcha') : null);
    $errorMessage = is_array($error) ? ($error[0] ?? null) : $error;
?>

<div class="form-group" id="captcha-group">
    <label for="captcha">Captcha</label>
    <div class="d-flex align-items-center gap-2">

        <button type="button" id="refresh-captcha" class="btn btn-s btn--secondary btn-short">
            <span class="btn__content">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                    <path d="M3 3v5h5"></path>
                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path>
                    <path d="M16 21h5v-5"></path>
                </svg>
            </span>
            <span class="btn__glitch"></span>
        </button>

        <div class="captcha-question" style="min-width: 100px;">
            {{ $captcha['question'] }}
        </div>

        <input type="text"
               id="captcha"
               name="captcha"
               class="form-control mt-2 @if($errorMessage) is-invalid @endif"
               placeholder="Введите ответ"
               autocomplete="off"
               value="{{ $oldInput['captcha'] ?? '' }}">
        @if($errorMessage)
            <div class="invalid-feedback" style="display: block;">{{ $errorMessage }}</div>
        @endif

    </div>
</div>

