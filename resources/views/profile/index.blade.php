@php
    use App\Models\User;

    /** @var User $user */
    /** @var string[] $name */
@endphp

@extends('layouts.main')

@section('title')
    Профиль пользователя
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="section-header">
                    <div class="section-label">Profile</div>
                    <h2 class="section-title">Мой профиль</h2>
                    <div class="section-divider" aria-hidden="true"></div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 ms-auto" style="perspective: 1200px; transform-style: preserve-3d; border-left: 1px dotted #00b0db">
                <div class="profile-main-panel js-cy-brackets" data-color="white" data-size="8">
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-4 col-xl-3">
                            <div class="photo-area">
                                <div class="pixel-grid" id="pixelGrid"></div>
                            </div>
                        </div>
                        <div class="col-8 col-sm-9 col-md-8 col-xl-9">
                            <h3 class="username tt-up">{{ $user->getFullNameOrEmail()}}</h3>
                        </div>
                    </div>
                    <br>


                    <p><span class="{{ $user->telegram ? 'cyan' : 'red' }} width-85">Telegram:</span> {{ $user->telegram}}</p>
                    <p><span class="{{ $user->email ? 'cyan' : 'red' }} width-85">Email:</span>{{ $user->email }}</p>
                    <p><span class="{{ $user->phone ? 'cyan' : 'red' }} width-85">Phone:</span>{{ $user->phone }}</p>

                    <div class="profile-main-panel-code-wrap">
                        <br>
                        <span class="cyan width-85">Code:</span>
                        <span class="js-cyber-text-animation cy-char p-lr-20 w-250 br-t1 ta-c bg-black" style="display: inline-block">
                                <span
                                data-target="0">1</span><span data-target="2">$</span><span
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

        <div class="data-panel" data-panel-id="main-data">
            <div class="data-panel__header p-12_">
                <div class="data-panel__dot"></div>
                <span class="data-panel__title">Ваши курсы</span>
                <div class="data-panel__line"></div>
                <span class="btn-collapse" data-action="collapse"> — </span>
            </div>
            <div class="data-panel__body data-stream">
                ---
            </div>
        </div>
        <br>
        <br>

        <div class="data-panel" data-panel-id="main-data">
            <div class="data-panel__header p-12_">
                <div class="data-panel__dot"></div>
                <span class="data-panel__title">Основные данные</span>
                <div class="data-panel__line"></div>
                <span class="btn-collapse" data-action="collapse"> — </span>
            </div>
            <div class="data-panel__body data-stream">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('POST')
                    {{-- Основные данные пользователя --}}
                    <div class="card_ mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Имя</label>
                                        <input type="text" id="name" name="name"
                                               value="{{ old('name', $user->name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="form-label">Фамилия</label>
                                        <input type="text" id="last_name" name="last_name"
                                               value="{{ old('last_name', $user->last_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email"
                                               value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Телефон</label>
                                        <input type="text" id="phone" name="phone"
                                               value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        @php
                                        $warn = empty($user->telegram) ? '<span class="font-tektur light-red ani-blink">Важно! укажите ваш настоящий аккаунт</span>' : '';
                                        @endphp
                                        <label for="telegram" class="form-label">Telegram <?= $warn?></label>
                                        <input type="text" id="telegram" name="telegram"
                                               value="{{ old('telegram', $user->telegram) }}" placeholder="@username">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-s btn--secondary_">
                            <span class="btn__content">Сохранить</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">r25</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <br>

        <div class="data-panel" data-panel-id="additional-data">
            <div class="data-panel__header">
                <div class="data-panel__dot"></div>
                <span class="data-panel__title">Дополнительные данные</span>
                <div class="data-panel__line"></div>
                <span class="btn-collapse" data-action="collapse"> — </span>
            </div>
            <div class="data-panel__body data-stream">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('POST')

                    {{-- Данные профиля --}}
                    <div class="card_ mb-4">
                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday" class="form-label">Дата рождения</label>
                                        <input type="text" id="birthday" name="birthday" placeholder="2000-01-01"
                                               value="{{ old('birthday', $user->profile?->birthday?->format('Y-m-d')) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Страна</label>
                                        <input type="text" id="country" name="country"
                                               value="{{ old('country', $user->profile->country) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Пол</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">Не указано</option>
                                            <option
                                                value="male" {{ old('gender', $user->profile->gender) === 'male' ? 'selected' : '' }}>
                                                Мужской
                                            </option>
                                            <option
                                                value="female" {{ old('gender', $user->profile->gender) === 'female' ? 'selected' : '' }}>
                                                Женский
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city" class="form-label">Город</label>
                                        <input type="text" id="city" name="city" placeholder="Москва"
                                               value="{{ old('city', $user->profile->city) }}">
                                    </div>
                                </div>
                                <div>
                                    <br>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="industry" class="form-label">Сфера деятельности</label>
                                        <input type="text" id="industry" name="industry"
                                               placeholder="Торговля, логистика"
                                               value="{{ old('industry', $user->profile->industry) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job" class="form-label">Должность</label>
                                        <input type="text" id="job" name="job" placeholder="Менеджер по развитию"
                                               value="{{ old('job', $user->profile->job) }}">
                                    </div>
                                </div>
                                <div>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="years_experience" class="form-label">Опыт работы в IT (лет)</label>
                                        <input type="text" id="years_experience" name="years_experience" placeholder="0"
                                               min="0" max="50"
                                               value="{{ old('years_experience', $user->profile->years_experience) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="github" class="form-label">GitHub</label>
                                        <input type="url" id="github" name="github"
                                               value="{{ old('github', $user->profile->github) }}"
                                               placeholder="https://github.com/username">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="obout" class="form-label">О себе</label>
                                        <textarea id="obout" name="obout" rows="4"
                                                  placeholder="Что нам нужно знать о вас?"
                                                  maxlength="1000">{{ old('obout', $user->profile->obout) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="custom-checkbox">
                                            <input type="hidden" name="is_free_offer" value="0">
                                            <input type="checkbox" id="is_free_offer" name="is_free_offer" value="1"
                                                {{ old('is_free_offer', $user->profile->is_free_offer) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                            <span class="label-text">Готов стажироваться бесплатно</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="custom-checkbox">
                                            <input type="hidden" name="is_money_offer" value="0">
                                            <input type="checkbox" id="is_money_offer" name="is_money_offer" value="1"
                                                {{ old('is_money_offer', $user->profile->is_money_offer) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                            <span class="label-text">Только оплачиваемая стажировка</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn--secondary_ btn-s" id="loadMoreVacancies" data-offset="6">
                            <span class="btn__content">Сохранить</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">xv-003</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <br>

        <div class="d-flex justify-content-end">
            <a href="{{ route('profile.update-password-view')  }}" class="btn btn-s btn--secondary">
                <span class="btn__content">Сменить пароль</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </a>
        </div>

    </div>
    <div style="margin-bottom: 150px"></div>
@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
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
</script>



<script>
document.addEventListener('DOMContentLoaded', function() {
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
        button.textContent = ' + ';
        button.setAttribute('data-action', 'collapse');
    }
    function setExpand(body, button) {
        body.style.display = 'block';
        button.textContent = ' — ';
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
