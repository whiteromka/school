<div class="container">
    <div class="row">
        {{-- Верхний процент загрузки --}}
        <div class="col-12 ta-c">
            <span class="clr-pink percent">
                <span class="js-main-loading-percent">0</span>
                <span>.00</span>
            </span>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 cy-block-main">
            {{--  Мобильная версия--}}
            <div class="d-block d-md-none text-center">
                <span data-cy-timer="1000" class="font-orbitron mb-0 js-cyber-text-once">
                    WELCOME
                </span>
            </div>
            {{--  Десктопная версия--}}
            <div class="d-none d-md-block text-center">
                <span data-cy-timer="1000" class="font-orbitron mb-0 js-cyber-text-once">
                    WELCOME_FRIEND
                </span>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        {{-- Нижний процент загрузки --}}
        <div class="col-12 ta-c">
            <span class="clr-pink percent">
                <span class="js-main-loading-percent">0</span>
                <span>.00</span>
            </span>
        </div>
    </div>

    <div class="row">
        {{-- Индикатор загрузки --}}
        <div class="col-sm-6 col-md-4 col-lg-2 offset-md-1 offset-lg-3 ta-c mb-2">
            <p style="margin-bottom: 2px;">LOADING: </p>
            <div class="br-r" style="height: 7px;">
                <div class="js-main-loading-style" style="height: 7px; width: 0%; background: #08f5e1"></div>
            </div>
        </div>
        {{-- Главный процент загрузки --}}
        <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 ta-c loading font-orbitron-slim js-cy-brackets"
             data-color="orange" data-type="bracket">
                <span class="clr-pink percent">
                    <span class="js-main-loading-percent">0</span>
                    <span>.00</span>
                </span>
        </div>
    </div>

</div>

<div class="container">

{{--    <h1 class="font-orbitron ta-r">01 .01 .01 1 1 .1</h1>--}}
    <h1 class="cy-ip font-tektur ta-r">
        {{ Auth::check() ? Auth::user()->getFullNameOrEmail() : $userIp }}
    </h1>
    <br>
    <br>
    <br>
    <p class="cy-text">"Живые" занятия и реальная настоящая поддержка менторов.
        Вы не просто смотрите записи — вы участвуете в интерактивных вебинарах,
        задаете вопросы в реальном времени и работаете вместе с группой под руководством опытных разработчиков.
        Теория + практика. Каждую тему разбираем от основ до техник которые повсеместно используются в боевых проектах.
        Закрепляем знания на практических задачах и мини-проектах.
    </p>
    <br>
    <br>
    <br>
    <span class="js-cyber-text-animation cy-btn_ cy-char  p-lr-20 w-300 br-r d-block ta-c">
        02 .02 02 .02 223 .02
    </span>
</div>
