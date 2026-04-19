@php
    use Illuminate\Support\Facades\Auth;

    /** @var string $userIp */
@endphp

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
        <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 ta-c loading font-orbitron-slim">
            <div class="js-cy-brackets"  data-color="red" data-type="bracket">
                <span class="clr-pink percent">
                <span class="js-main-loading-percent">0</span>
                <span>.00</span>
                </span>
            </div>
        </div>
    </div>

</div>

<div class="container">
    @php
        $css = (Auth::check() && Auth::user()->getFullNameOrEmail()) ? 'font-tektur' : 'font-orbitron';
    @endphp
    <h1 class="cy-ip {{ $css }} ta-r">
        {{ Auth::check() ? Auth::user()->getFullNameOrEmail() : $userIp }}
    </h1>
    <div style="height: 80px"></div>
    <p class="cy-text fs-p_ ">"Живые" занятия и реальная настоящая поддержка менторов.
        Вы не просто смотрите записи — вы участвуете в интерактивных вебинарах,
        задаете вопросы в реальном времени и работаете вместе с группой под руководством опытных разработчиков.
        Теория + практика. Каждую тему разбираем от основ до техник которые повсеместно используются в боевых проектах.
        Закрепляем знания на практических задачах и мини-проектах.
    </p>
    <div style="height: 80px"></div>
</div>

<div class="container soon-modules-wrapper info-body_ px-0">
    @php
        $soonCourses = [
            ['name' => 'Backend PHP OOP', 'date' => 'XX .XX. 2026'],
            ['name' => 'Gamedev 3d modeling', 'date' => 'XX .XX. 2026'],
            ['name' => 'English with Elijah', 'date' => 'XX .XX. 2026'],
        ];
    @endphp
    <div class="soon-modules">
        <div class="info-body">
            <h4 class="soon-modules-header">!Скоро начинаем</h4>
            <br>
            <div class="container px-0">
                @foreach($soonCourses as $course)
                    <div class="row soon-module fs-p-small p-10">

                            {{-- левая  часть --}}
                            <div class="col-1 col-sm-2 col-lg-1">
                                  <span class="p-lr-10 dark-grey font-orbitron fs-20_">
                                      <b style="display: block">⫶⫶</b> <b style="display: block">⫶⫶</b>
                                  </span>
                            </div>

                            {{--  основная часть --}}
                            <div class="col-8 col-sm-8 col-lg-10">
                                <span class="course-name w-150_ fs-p">
                                    <?= $course['name']?>
                                </span>
                                <span class="course-date js-cyber-text-animation cy-char br-r ta-c p-1 w-175 fs-p-small">
                                    <?= $course['date']?>
                                </span>

                            </div>

                            {{-- правая часть - кнопки --}}
                            <div class="col-2 col-sm-1 col-lg-1">
                                  <a class="font-orbitron soon-module-arrow-wrapper" href="#">
                                      <svg class="soon-module-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                          <path d="M439.1 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L371.2 256 233.9 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L179.2 256 41.9 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z"/>
                                      </svg>
                                  </a>
                            </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
