<div class="container section">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="section-header">
                <div class="section-label">Login</div>
                <h2 class="section-title">АВТОРИЗАЦИЯ</h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mx-auto">

            <div class="custom-block mt-1">
                <div class="trapezoid-bottom"></div>
                <div class="custom-block-content" style="text-align: center">
                    <p class="login-form-text">Можете авторизоваться через</p>

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

            <form method="POST" action="{{ url('/login') }}" class="contact-form" aria-label="Contact form" >
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="your@email.com" autocomplete="name" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" autocomplete="email" />
                </div>

                <div class="col-12 px-1 d-flex justify-content-end">
                    <button class="btn btn--secondary btn-s" id="loadMoreVacancies" data-offset="6">
                        <span class="btn__content">Login</span>
                        <span class="btn__glitch"></span>
                        <span class="btn__label">xv-003</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
