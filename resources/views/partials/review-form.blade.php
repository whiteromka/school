@php
    $activeModules = $activeModules ?? [];
    $oldInput = $oldInput ?? [];
    $success = $success ?? false;
    $captcha = $captcha ?? null;
    $errors = $errors ?? [];
@endphp

<div class="review-form-container">
    @if($success)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Отзыв успешно добавлен.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form id="review-form" class="contact-form" method="POST">
        @csrf

        <div class="form-group">
            <label for="modules_id">Module</label>
            <select id="modules_id" name="modules_id" class="form-control {{ isset($errors['modules_id']) ? 'is-invalid' : '' }}">
                <option value="">Модуль</option>
                @foreach($activeModules as $id => $name)
                    <option value="{{ $id }}" {{ (isset($oldInput['modules_id']) && $oldInput['modules_id'] == $id) ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if(isset($errors['modules_id']))
                <div class="invalid-feedback" style="display: block;">{{ $errors['modules_id'][0] }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="stars">Stars</label>
            <select id="stars" name="stars" class="form-control {{ isset($errors['stars']) ? 'is-invalid' : '' }}">
                <option value="">Оценка</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ (isset($oldInput['stars']) && $oldInput['stars'] == $i) ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            @if(isset($errors['stars']))
                <div class="invalid-feedback" style="display: block;">{{ $errors['stars'][0] }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control {{ isset($errors['message']) ? 'is-invalid' : '' }}" rows="5">{{ $oldInput['message'] ?? '' }}</textarea>
            @if(isset($errors['message']))
                <div class="invalid-feedback" style="display: block;">{{ $errors['message'][0] }}</div>
            @endif
        </div>

        @if(isset($errors['auth']))
            <div class="invalid-feedback" style="display: block; margin-bottom: 10px;">{{ $errors['auth'][0] }}</div>
        @endif

        {{-- Капча --}}
        @include('partials.captcha', ['error' => $errors['captcha'] ?? null])

        <div class="d-flex align-items-center justify-content-end">
            @guest
                <div class="sign-error js-cy-brackets" data-color="red" data-context="Требуется авторизация">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">
                        <path fill="red" d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z"></path>
                    </svg>
                    <i>auth</i>
                </div>
                <button type="submit" id="review-submit-btn" class="btn btn-s" disabled>
                    <span class="btn__content">Отправить</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </button>
            @else
                <button type="submit" id="review-submit-btn" class="btn btn-s">
                    <span class="btn__content">Отправить</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </button>
            @endguest
        </div>
    </form>
</div>
