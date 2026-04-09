@php

/** @var \App\Models\User $user */
@endphp
<div class="data-panel" data-panel-id="courses">
    @include('components.profile._profile-data-head', ['name' => 'Ваши курсы'])
    <div class="data-panel__body data-stream container">

        @php $i = 1; @endphp
        @foreach($user->activeModules as $activeModule)
            <div class="service-card mb-2" data-users-count="2" data-max-users="94">

                <div class="service-index">
                    <div class="left d-flex flex-column flex-sm-row align-items-center gap-2 gap-sm-3">
                        <span>{{ $i <= 9 ? '0' : ''  }}{{ $i }}</span>
                        <div class="service-name" style="display: inline-block; font-size: 15px">
                            {{ $activeModule->module->name }}  <span class="dark-grey"> / </span>
                            <span class="orange"> {{ $activeModule->module->module_price  }} RUR </span>
                        </div>
                    </div>
                </div>
                <ul>
                    <li>status: {{ $activeModule->getRuStatus() }}</li>
                    <li>Начало занятий: {{ ($activeModule->started_at === null) ? '--' : $activeModule->started_at->format('d.m.Y') }}</li>
                    <li>Приблизительный конец: {{ ($activeModule->ended_at === null) ? '--' : $activeModule->ended_at->format('d.m.Y') }}</li>
                    <li>Автор: {{ $activeModule->module->author }}</li>
                    <li>Расписание: {{ $activeModule->module->schedule }}</li>
                </ul>



                <div>
                    <div class="d-flex justify-content-end">
                        <div>
                            <button class="btn btn-s btn--success">
                                <span class="btn__content">Оплатить</span>
                                <span class="btn__glitch"></span>
                                <span class="btn__label">r25</span>
                            </button>

                            <button class="btn btn-s btn--secondary">
                                <span class="btn__content">Выписаться</span>
                                <span class="btn__glitch"></span>
                                <span class="btn__label">r25</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @php $i++; @endphp
        @endforeach

{{--        <table class="table table-dark">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th scope="col">#</th>--}}
{{--                <th scope="col">Курс</th>--}}
{{--                <th scope="col">Статус</th>--}}
{{--                <th scope="col">Статус оплаты</th>--}}
{{--                <th scope="col">Дата начала</th>--}}
{{--                <th scope="col">Дата окончания</th>--}}
{{--                <th scope="col">Преподаватель</th>--}}
{{--                <th scope="col">Расписание</th>--}}
{{--                <th scope="col">Действия</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @php--}}
{{--                $number = 1;--}}
{{--            @endphp--}}
{{--            @foreach($user->activeModules as $activeModule)--}}
{{--                <tr>--}}
{{--                    <th scope="row"> {{ $number++ }} </th>--}}
{{--                    <td>{{ $activeModule->module->name }}</td>--}}
{{--                    <td>{{ $activeModule->getRuStatus() }}</td>--}}
{{--                    <td>--</td>--}}
{{--                    <td>{{ ($activeModule->started_at === null) ? '--' : $activeModule->started_at->format('d.m.Y') }}</td>--}}
{{--                    <td>{{ ($activeModule->ended_at === null) ? '--' : $activeModule->ended_at->format('d.m.Y') }}</td>--}}
{{--                    <td>{{ $activeModule->module->author }}</td>--}}
{{--                    <td>{{ $activeModule->module->schedule }}</td>--}}
{{--                    <td>--}}
{{--                        <a class="btn btn-small btn-success" href="" target="_blank">--}}
{{--                            Оплатить--}}
{{--                        </a>--}}
{{--                        <a class="btn btn-small btn-danger" href="" target="_blank">--}}
{{--                            Покинуть--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
    </div>
</div>
