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
                    <h3 class="username tt-up">
                        {{ $user->getFullNameOrEmail()}}
                    </h3>
                    <p>{{ $user->telegram}}</p>
                    <p>{{ $user->email }}</p>
                    <p>{{ $user->phone }}</p>

                    <div class="profile-main-panel-code-wrap">
                        <br>
                        <span class="js-cyber-text-animation cy-char p-lr-20 w-250 br-t1 d-block ta-c bg-black" style="display: inline-block">
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

        <div class="data-panel">
            <div class="data-panel__header p-12">
                <div class="data-panel__dot"></div>
                <span class="data-panel__title">Основные данные</span>
                <div class="data-panel__line"></div>
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
                                    <div class="form-group">
                                        @php
                                        $warn = empty($user->telegram) ? '<span class="orange">Важно! укажите ваш настоящий аккаунт</span>' : '';
                                        @endphp
                                        <label for="telegram" class="form-label">Telegram <?= $warn?></label>
                                        <input type="text" id="telegram" name="telegram"
                                               value="{{ old('telegram', $user->telegram) }}" placeholder="@username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" name="username"
                                               value="{{ old('username', $user->username) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-s btn--secondary">
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
        <div class="data-panel">
            <div class="data-panel__header p-12">
                <div class="data-panel__dot"></div>
                <span class="data-panel__title">Дополнительные данные</span>
                <div class="data-panel__line"></div>
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
                        <button class="btn btn--secondary btn-s" id="loadMoreVacancies" data-offset="6">
                            <span class="btn__content">Сохранить</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">xv-003</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 150px"></div>
@endsection
