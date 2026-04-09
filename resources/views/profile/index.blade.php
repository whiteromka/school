@php
    use App\Models\User;use Illuminate\Support\Carbon;

    /** @var User $user */
    /** @var string[] $name */
@endphp

@extends('layouts.main')

@section('title')
    Профиль пользователя
@endsection

@section('content')

    <div class="container py-5 px-0">
        <div class="row">
            <div class="col-md-6">
                <div class="section-header">
                    <div class="section-label">Profile</div>
                    <h2 class="section-title">Мой профиль</h2>
                    <div class="section-divider" aria-hidden="true"></div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 ms-auto profile-card">
                <div class="profile-main-panel js-cy-brackets" data-color="white" data-size="8">
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-4 col-xl-3">
                            <div class="photo-area">
                                <div class="pixel-grid" id="pixelGrid"></div>
                            </div>
                        </div>
                        <div class="col-8 col-sm-9 col-md-8 col-xl-9">
                            <h3 class="username tt-up">{{ $user->getFullNameOrEmail() }}</h3>
                        </div>
                    </div>
                    <br>

                    <p><span class="{{ $user->telegram ? 'cyan' : 'red' }} width-85">Telegram:</span> {{ $user->telegram}}</p>
                    <p><span class="{{ $user->email ? 'cyan' : 'red' }} width-85">Email:</span>{{ $user->email }}</p>
                    <p><span class="{{ $user->phone ? 'cyan' : 'red' }} width-85">Phone:</span>{{ $user->phone }}</p>

                    <div class="profile-main-panel-code-wrap">
                        <br>
                        <span class="cyan width-85">Code:</span>
                        <span class="js-cyber-text-animation cy-char p-lr-20 w-250 br-t1 ta-c bg-black"
                              style="display: inline-block">
                                <span data-target="0">1</span><span data-target="2">$</span><span
                                data-target=" ">G</span><span data-target=".">L</span><span
                                data-target="0">Y</span><span data-target="2">%</span><span
                                data-target=" ">5</span><span data-target="0">N</span><span
                                data-target="2">8</span><span data-target=" ">D</span><span
                                data-target=".">Y</span><span data-target="0">Z</span><span
                                data-target="2">9</span><span data-target=" ">A</span><span
                                data-target="2">O</span><span data-target="2">O</span><span
                                data-target="3">%</span><span data-target=" ">W</span><span
                                data-target=".">V</span><span data-target="0">&gt;</span><span data-target="2">P</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 60px"></div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="info-body__no-line-height">
            @include('components.profile.courses')
            <br>
            @include('components.profile.basic-data')
            <br>
            @include('components.profile.additional-data')
            <br>
            @include('components.profile.reviews', ['user' => $user])
            <br>
            @include('components.profile.password')
            <br>
        </div>

    </div>
    <div style="margin-bottom: 150px"></div>
@endsection

@push('scripts')

    <script>
        // Анимации визитки пользователя
        document.addEventListener('DOMContentLoaded', function () {
            // Создаем сетку пикселей
            const grid = document.getElementById('pixelGrid');
            const pixelCount = 36; // 10x10 сетка (или любое другое значение)

            // Вычисляем размер стороны квадрата
            const gridSize = Math.floor(Math.sqrt(pixelCount));

            // Устанавливаем CSS Grid для квадратной сетки
            grid.style.display = 'grid';
            grid.style.gridTemplateColumns = `repeat(${gridSize}, 1fr)`;
            grid.style.gridTemplateRows = `repeat(${gridSize}, 1fr)`;
            grid.style.gap = '2px';
            grid.style.width = '100%';
            grid.style.aspectRatio = '1 / 1';

            // Создаем пиксели
            for (let i = 0; i < pixelCount; i++) {
                const pixel = document.createElement('div');
                pixel.className = 'pixel';
                pixel.style.width = '100%';
                pixel.style.height = '100%';
                grid.appendChild(pixel);
            }

            const pixels = document.querySelectorAll('.pixel');

            // Функция для генерации случайного оттенка красного
            function getRandomRedShade() {
                // Базовый красный: hsl(0, 70%, 50%)
                // Варьируем lightness от 20% до 80%
                const lightness = Math.floor(Math.random() * 60) + 20; // 20-80%
                const saturation = Math.floor(Math.random() * 40) + 60; // 60-100%
                return `hsl(0, ${saturation}%, ${lightness}%)`;
            }

            // Функция для обновления цветов 30 случайных пикселей
            function updateRandomPixels() {
                // Создаем массив индексов
                const indices = Array.from({length: pixels.length}, (_, i) => i);

                // Перемешиваем массив (Fisher-Yates shuffle)
                for (let i = indices.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [indices[i], indices[j]] = [indices[j], indices[i]];
                }

                // Берем первые 30 пикселей
                const count = 30;

                for (let i = 0; i < count; i++) {
                    const pixelIndex = indices[i];
                    pixels[pixelIndex].style.backgroundColor = getRandomRedShade();
                }
            }

            // Инициализация начальных цветов
            pixels.forEach(pixel => {
                pixel.style.backgroundColor = getRandomRedShade();
            });

            // Обновляем каждую секунду
            setInterval(updateRandomPixels, 1000);
        });

        // Панели и состояние
        document.addEventListener('DOMContentLoaded', function () {
            const STORAGE_KEY = 'profile_panels_state';

            /**
             * Сохранить состояние панели в localStorage
             */
            function savePanelState(panelId, isExpanded) {
                const panelsState = getPanelsState();
                panelsState[panelId] = isExpanded ? 'expanded' : 'collapsed';
                localStorage.setItem(STORAGE_KEY, JSON.stringify(panelsState));
            }

            /**
             * Получить состояние всех панелей из localStorage
             */
            function getPanelsState() {
                const savedState = localStorage.getItem(STORAGE_KEY);
                return savedState ? JSON.parse(savedState) : {};
            }

            /**
             * Проверить, свёрнута ли панель в данный момент
             */
            function isPanelCollapsed(body) {
                const style = window.getComputedStyle(body);
                return style.display === 'none';
            }

            function setCollapse(body, button) {
                body.style.display = 'none';
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M214.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-160-160c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 402.7 329.4 265.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-160 160zm160-352l-160 160c-12.5 12.5-32.8 12.5-45.3 0l-160-160c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 210.7 329.4 73.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3z"/></svg>';
                button.setAttribute('data-action', 'collapse');
            }

            function setExpand(body, button) {
                body.style.display = 'block';
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160zm160 352l-160-160c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 329.4 438.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3z"/></svg>';
                button.setAttribute('data-action', 'expand');
            }

            /**
             * Переключить видимость панели
             */
            function togglePanel(button) {
                const header = button.closest('.data-panel__header');
                const panel = header.closest('.data-panel');
                const body = panel.querySelector('.data-panel__body');
                if (!body) return;

                const wasCollapsed = isPanelCollapsed(body);
                const panelId = panel.dataset.panelId || panel.querySelector('.data-panel__title')?.textContent?.trim() || '';
                if (!panelId) return;

                // Переключить видимость
                if (wasCollapsed) {
                    setExpand(body, button)
                } else {
                    setCollapse(body, button)
                }

                // Сохранить НОВОЕ состояние в localStorage (после переключения)
                savePanelState(panelId, wasCollapsed);
            }

            /**
             * Восстановить состояние панелей из localStorage
             */
            function restorePanelStates() {
                const panelsState = getPanelsState();
                const panels = document.querySelectorAll('.data-panel');

                // Применить сохранённое состояние к каждой панели
                panels.forEach(panel => {
                    const panelId = panel.dataset.panelId || panel.querySelector('.data-panel__title')?.textContent?.trim();
                    if (!panelId || !panelsState.hasOwnProperty(panelId)) return;

                    const state = panelsState[panelId];
                    const body = panel.querySelector('.data-panel__body');
                    const button = panel.querySelector('.btn-collapse');
                    if (!body || !button) return;

                    if (state === 'collapsed') {
                        setCollapse(body, button)
                    } else {
                        setExpand(body, button)
                    }
                });
            }

            /**
             * Инициализировать функционал сворачивания
             */
            function initCollapse() {
                // Добавить обработчики клика ко всем кнопкам сворачивания
                const collapseButtons = document.querySelectorAll('.btn-collapse');

                collapseButtons.forEach(button => {
                    button.addEventListener('click', (e) => {
                        e.preventDefault();
                        togglePanel(button);
                    });
                });

                // Восстановить сохранённые состояния
                restorePanelStates();
            }

            // Инициализация
            initCollapse();
        });
    </script>
@endpush
