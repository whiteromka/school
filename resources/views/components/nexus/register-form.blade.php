<div class="container section">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="section-header">
                <div class="section-label">Register</div>
                <h2 class="section-title">РЕГИСТРАЦИЯ</h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mx-auto">

            <div class="custom-block mt-1">
                <div class="trapezoid-bottom"></div>
                <div class="custom-block-content ta-c">
                    <p class="login-form-text">Можете зарегистрироваться через</p>
                    <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id={{ config('services.yandex.client_id') }}" class="btn btn-s btn--primary" id="loadMoreVacancies" data-offset="6">
                        <span class="btn__content">Yandex</span>
                        <span class="btn__glitch"></span>
                        <span class="btn__label">xv-003</span>
                    </a>
                    <br>
                    <br>
                    <a href="{{ route('google.login') }}" class="btn btn-s btn--primary" id="loadMoreVacancies" data-offset="6">
                        <span class="btn__content">Google</span>
                        <span class="btn__glitch"></span>
                        <span class="btn__label">xv-003</span>
                    </a>
                    <br>
                    <br>
                    <a href="https://github.com/login/oauth/authorize?client_id={{ config('services.github.client_id') }}&redirect_uri" class="btn btn-s btn--primary" id="loadMoreVacancies" data-offset="6">
                        <span class="btn__content">Github</span>
                        <span class="btn__glitch"></span>
                        <span class="btn__label">xv-003</span>
                    </a>
                    <br>
                    <br>
                    <a href="#" class="btn btn-s btn--primary" id="loadMoreVacancies" data-offset="6">
                        <span class="btn__content">Telegram</span>
                        <span class="btn__glitch"></span>
                        <span class="btn__label">xv-003</span>
                    </a>

                </div>
                <div class="trapezoid-top"></div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4 mt-3_ mx-auto">
            <br>
            <p class="login-form-text">или</p>

            <form method="POST" action="{{ url('/register') }}" class="contact-form" aria-label="Contact form" >
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="@error('name') is-invalid @enderror" id="name" name="name" placeholder="Имя" value="{{ old('name') }}"/>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input class="@error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Фамилия" value="{{ old('last_name') }}"/>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="your@email.com" autocomplete="email" value="{{ old('email') }}"/>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="@error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Пароль" value="{{ old('password') }}"/>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password repeat</label>
                    <input class="@error('password_confirmation') is-invalid @enderror" type="password" id="password_confirmation" name="password_confirmation" placeholder="Повтор пароля" value="{{ old('password_confirmation') }}"/>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 px-1 d-flex justify-content-end">
                    <button class="btn btn--secondary btn-s" id="loadMoreVacancies" data-offset="6">
                        <span class="btn__content">Register</span>
                        <span class="btn__glitch"></span>
                        <span class="btn__label">xv-003</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
