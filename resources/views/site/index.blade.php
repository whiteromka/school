@php
    /** @var string $userIp */
    /** @var array $activeModules */
@endphp

@extends('layouts.main')

@section('title', 'Групповые курсы по программированию')

@section('content')
{{-- Вступительный контейнер    --}}
@include('components.cyber.main-first', ['userIp' => $userIp])
<br>
<br>
<br>
<br>

<x-ico-tech></x-ico-tech>

{{-- ========  ABOUT =========--}}
<div style="height: 80px"></div>
@include('components.nexus.about')
<div style="height: 150px"></div>

{{--  Контейнер преимущества  --}}
@include('components.cyber.advantages')

{{-- ====  Учебный процесс  ==== --}}
@include('components.nexus.learning-process-blocks')
<div style="height: 100px"></div>

{{--  FAQ на основе col из бутстрапа  --}}
@include('components.cyber.faq-slider')
<div style="height: 150px"></div>


<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">training</div>
            <h2 class="section-title">Чему учим</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>
<div class="container">
    <div>
        {{-- Табы --}}
        <ul class="nav nav-tabs cy-item-tabs fs-13" id="tech" role="tablist" style="display: flex; justify-content: center">
            <li class="nav-item " role="presentation">
                <button class="nav-link active "
                        data-bs-toggle="tab"
                        data-bs-target="#web"
                        type="button">
                    web
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#foreign_language"
                        type="button">
                    English
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#gamedev"
                        type="button">
                    Gamedev
                </button>
            </li>
        </ul>
        <br>

        {{-- Таб контент --}}
        <div class="tab-content cy-item-tabs-content">
            <div class="tab-pane fade show active" id="web">
                {{-- Двойной контейнер с 3d визуализацией --}}
                <p class="grey">
                    В основном мы специализируемся на web технологиях фронтенд и бекенд.
                    Фронтенд - пользовательская часть приложения. Бекенд серверная сторона где хранятся данные и выполняется вся логика.
                    Так же у нас есть курс по gamedev(unity) и Английскому языку
                </p>
                <br>
                <x-cyber.perspective3d></x-cyber.perspective3d>
                <br>
                {{-- Контейнер network с технологиями --}}
                <x-network.network-wrapper></x-network.network-wrapper>
            </div>
            <div class="tab-pane fade" id="foreign_language">
                <p>тут про english</p>
            </div>
            <div class="tab-pane fade" id="gamedev">
                <p>тут про gamedev</p>
            </div>
        </div>
    </div>
</div>
<div style="height: 150px"></div>

{{-- Контейнер с курсами \ модулями (items)  --}}
@include('components.cyber.courses')
<div style="height: 60px"></div>

{{-- Вакансии --}}
@include('components.nexus.vacancies')
<div style="height: 150px"></div>

@include('components.cyber.x2')
<div style="height: 150px"></div>

<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">finaly...</div>
            <h2 class="section-title" >Тут конец...</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>

{{-- Обычный двойной Контейнер --}}
<x-cyber.simple-double></x-cyber.simple-double>
<div style="height: 150px"></div>

<div class="container section">
    <div class="row">
        <div class="col-md-6">
            <div class="section-header">
                <div class="section-label">Reviews</div>
                <h2 class="section-title">Оставь отзыв</h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
        </div>
    </div>

{{--  Отзывы  --}}
    <div class="row">
        <div class="col-md-8">
            <p class="grey">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium atque consequuntur corporis
                deleniti dignissimos eaque eligendi illum itaque labore laborum, possimus praesentium quam tempore
                ut velit. Ab aliquid ea eum magnam, necessitatibus neque nisi. Dolores minima nisi nulla rem veniam.
            </p>
        </div>
        <div class="col-md-4">

            <div class="review-form-container" id="review-form-container">
                @include('partials.review-form', ['activeModules' => $activeModules])
            </div>

            @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const container = document.getElementById('review-form-container');
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                        // Обработчик отправки формы (делегирование событий)
                        container.addEventListener('submit', async function(e) {
                            e.preventDefault();

                            const form = e.target;
                            const submitBtn = form.querySelector('#review-submit-btn');
                            const btnContent = submitBtn?.querySelector('.btn__content');

                            if (!submitBtn || submitBtn.disabled) return;

                            // Блокировка кнопки
                            submitBtn.disabled = true;
                            if (btnContent) {
                                btnContent.textContent = 'Отправка...';
                            }

                            // Сбор данных формы
                            const formData = new FormData(form);

                            try {
                                const response = await fetch('/review/store', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'text/html'
                                    }
                                });

                                const html = await response.text();
                                container.innerHTML = html;

                            } catch (error) {
                                console.error('Error submitting review:', error);
                            }
                        });

                        // Очистка ошибок при вводе
                        container.addEventListener('input', function(e) {
                            const target = e.target;
                            if (target.tagName === 'SELECT' || target.tagName === 'TEXTAREA') {
                                target.classList.remove('is-invalid');
                                const errorEl = target.parentElement.querySelector('.invalid-feedback');
                                if (errorEl) {
                                    errorEl.style.display = 'none';
                                }
                            }
                        });
                    });
                </script>
            @endpush

        </div>
    </div>
</div>

@include('components.footer-dark')
<br>
<br>
<br>

{{--<x-nexus></x-nexus>--}}
@endsection
