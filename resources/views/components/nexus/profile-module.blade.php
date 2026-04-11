@php
    use App\Models\ActiveModule;
    use App\Models\Module;

    /** @var int $i */
    /** @var int $max */
    /** @var Module $module */
    /** @var ActiveModule $activeModule */

    $i = $i ?? 1;
    $max = $max ?? 94;
@endphp

<div class="module profile-module"
     data-users-count="{{ $module->openActiveModule?->users->count() ?? 0 }}"
     data-max-users="{{ $max }}"
>
    <div class="module-inner">

        <div class="row module-header">
            <div class="col-12 col-md-1">
                <h3>0{{ $i  }} </h3>
            </div>
            <div class="col-12 col-md-11 module-header-main">
                <span>{{ $module->name }}</span>
                <span class="dark-grey">&nbsp;&nbsp;  //  &nbsp;&nbsp;</span>
                <span class="orange_"> {{ $module->module_price }} RUR </span>
            </div>
        </div>
        <br>


        <div class="module-props">
            <div class="container px-2">
                <div class="row mb-2_">
                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Стоимость за урок: </span>
                            <span class="orange">{{ $module->lesson_price }} RUR</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Продолжительность:</span>
                            <span class="cyan">{{ $module->duration }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Количество уроков:</span>
                            <span class="cyan"> {{ $module->count_lessons }}+</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Сложность:</span>
                            <span class="cyan">{{ $module->level }} / 10 </span>
                        </div>
                    </div>


                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Автор:</span>
                            <span class="cyan">{{ $module->author }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Дата начала:</span>
                            <span class="cyan" style="font-family: 'Tektur', sans-serif">{{ $activeModule->started_at?->format('d.m.Y') }}</span>
                        </div>
                    </div>
{{--                    <div class="col-12 col-md-6 col-lg-3 px-1">--}}
{{--                        <div class="prop">--}}
{{--                            <span class="">Дата окончания:</span>--}}
{{--                            <span class="cyan" style="font-family: 'Tektur', sans-serif">{{ $activeModule->ended_at?->format('d.m.Y') }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Расписание:</span>
                            <span class="cyan" style="font-family: 'Tektur', sans-serif">{{ $activeModule->ended_at?->format('d.m.Y') }}</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 px-1">
                        <div class="prop">
                            <span class="">Статус модуля</span>
                            <span class="cyan" style="font-family: 'Tektur', sans-serif">{{ $activeModule->getRuStatus() }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{--  Кнопки купить / выписаться --}}
        <div class="d-flex justify-content-end">
            <div>
                <button class="btn btn-s btn--success">
                    <span class="btn__content">Оплатить</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </button>

                <button class="btn btn-s btn--secondary">
                    <span class="btn__content">Выйти</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </button>
            </div>
        </div>

    </div>
</div>
