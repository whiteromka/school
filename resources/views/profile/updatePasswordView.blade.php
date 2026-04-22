@php
    use App\Models\User;

    /** @var User $user */
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
            <div class="col-md-6 col-xl-4 ms-auto"
                 style="perspective: 1200px; transform-style: preserve-3d; border-left: 1px dotted #00b0db">
                <div class="profile-main-panel js-cy-brackets" data-color="white" data-size="8">
                    <h3 class="username tt-up">
                        {{ $user->getNameOrEmail()}}
                    </h3>
                    <p>{{ $user->telegram}}</p>
                    <p>{{ $user->email }}</p>
                    <p>{{ $user->phone }}</p>

                    <div class="profile-main-panel-code-wrap">
                        <br>
                        <span class="js-cyber-text-animation cy-char p-lr-20 w-250 br-t1 d-block ta-c bg-black"
                              style="display: inline-block">
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
                                    data-target=".">V</span><span data-target="0">&gt;</span><span
                                    data-target="2">P</span>
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
                <span class="data-panel__title">Пароль</span>
                <div class="data-panel__line"></div>
            </div>
            <div class="data-panel__body data-stream">
                <form action="{{ route('profile.update-password') }}" method="POST" id="passwordUpdateForm">
                    @csrf
                    @method('POST')
                    {{-- Пароль --}}
                    <div class="card_ mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    @php
                                        $warn = $user->password_verified !== 1 ? '<p class="font-tektur_ orange ani-blink_">
                                            Вы входили на сайт через соцсети, мы сгенерировали вам случайный пароль, смените его если хотите иметь резервный способ входа на сайт
                                        </p>' : '';
                                        if ($warn) {
                                            echo $warn;
                                        }
                                    @endphp
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-15_">
                                        <label for="password" class="form-label">Новый пароль</label>
                                        <input type="password" id="password" name="password"
                                               value="{{ old('password') }}">
                                        @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">подтверждение
                                            пароля</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               value="{{ old('password_confirmation') }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-s btn--secondary_">
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

        <div class="d-flex justify-content-end">
            <a href="{{ route('profile.index') }}" class="btn btn-s btn--secondary_">
                <span class="btn__content">в профиль</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </a>
        </div>
        <br>
        <br>

    </div>
    <div style="margin-bottom: 150px"></div>
@endsection

