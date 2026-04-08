<div class="data-panel" data-panel-id="courses">
    <div class="data-panel__header p-12_">
        <div class="data-panel__dot"></div>
        <span class="data-panel__title">Ваши курсы</span>
        <div class="data-panel__line"></div>
        <span class="btn-collapse" data-action="collapse"> — </span>
    </div>
    <div class="data-panel__body data-stream">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Курс</th>
                <th scope="col">Статус</th>
                <th scope="col">Статус оплаты</th>
                <th scope="col">Дата начала</th>
                <th scope="col">Дата окончания</th>
                <th scope="col">Преподаватель</th>
                <th scope="col">Расписание</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @php
                $number = 1;
            @endphp
            @foreach($user->activeModules as $activeModule)
                <tr>
                    <th scope="row"> {{ $number++ }} </th>
                    <td>{{ $activeModule->module->name }}</td>
                    <td>{{ $activeModule->getRuStatus() }}</td>
                    <td>--</td>
                    <td>{{ ($activeModule->started_at === null) ? '--' : $activeModule->started_at->format('d.m.Y') }}</td>
                    <td>{{ ($activeModule->ended_at === null) ? '--' : $activeModule->ended_at->format('d.m.Y') }}</td>
                    <td>{{ $activeModule->module->author }}</td>
                    <td>{{ $activeModule->module->schedule }}</td>
                    <td>
                        <a class="btn btn-small btn-success" href="" target="_blank">
                            Оплатить
                        </a>
                        <a class="btn btn-small btn-danger" href="" target="_blank">
                            Покинуть
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
