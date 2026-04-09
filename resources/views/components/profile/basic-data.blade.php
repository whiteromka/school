<div class="data-panel" data-panel-id="main-data">
    @include('components.profile._profile-data-head', ['name' => 'Основные данные'])
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
                                <label for="telegram" class="form-label">Telegram <?= $warn ?></label>
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
