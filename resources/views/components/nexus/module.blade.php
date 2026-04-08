@php
    use App\Models\Module;

    /** @var int $i */
    /** @var int $max */
    /** @var Module $module */

    $i = $i ?? 1;
    $max = $max ?? 94;
@endphp

<div class="service-card course-module mb-1"
     data-users-count="{{ $module->openActiveModule?->users->count() ?? 0 }}"
     data-max-users="{{ $max }}">

    <div class="service-index">
        <div class="left d-flex flex-column flex-sm-row align-items-center gap-2 gap-sm-3">
            <span>0<?= $i ?></span>
            <div class="service-card-count-line-wrap w-100 w-sm-auto" data-context="Записалось на бесплатную часть">
                <div class="service-card-count-line">
                </div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="icon-grey">
                        <path
                            d="M320 16a104 104 0 1 1 0 208 104 104 0 1 1 0-208zM96 88a72 72 0 1 1 0 144 72 72 0 1 1 0-144zM0 416c0-70.7 57.3-128 128-128 12.8 0 25.2 1.9 36.9 5.4-32.9 36.8-52.9 85.4-52.9 138.6l0 16c0 11.4 2.4 22.2 6.7 32L32 480c-17.7 0-32-14.3-32-32l0-32zm521.3 64c4.3-9.8 6.7-20.6 6.7-32l0-16c0-53.2-20-101.8-52.9-138.6 11.7-3.5 24.1-5.4 36.9-5.4 70.7 0 128 57.3 128 128l0 32c0 17.7-14.3 32-32 32l-86.7 0zM472 160a72 72 0 1 1 144 0 72 72 0 1 1 -144 0zM160 432c0-88.4 71.6-160 160-160s160 71.6 160 160l0 16c0 17.7-14.3 32-32 32l-256 0c-17.7 0-32-14.3-32-32l0-16z"/>
                    </svg>
                </span>
            </div>
        </div>
        <div class="right">
            <div>
                <span><span class="orange_"><?= $module->lesson_price ?> RUR</span> за урок</span>
                <span><span class="cyan_"><?= $module->duration ?></span></span>
                <span><span class="cyan_"><?= $module->count_lessons ?></span> уроков</span>
                <span><span class="cyan_"><?= $module->level ?> / 10 </span> сложность</span>
            </div>
        </div>
    </div>
    <div class="service-name" style="display: inline-block">
        <?= $module->name ?>
        <span class="dark-grey"> / </span>
        <span class="orange"> <?= $module->module_price ?> RUR </span>
    </div>

    <div class="php-tabs-wrapper_">
        <ul class="nav nav-tabs cy-item-tabs" id="a{{ $i }}" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#text{{ $i }}"
                        type="button" aria-selected="true" role="tab">
                    Описание
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " data-bs-toggle="tab" data-bs-target="#topics{{ $i }}"
                        type="button" aria-selected="false" tabindex="-1" role="tab">
                    Темы модуля
                </button>
            </li>
        </ul>

        <div class="tab-content cy-item-tabs-content">
            <div class="tab-pane fade show active" id="text{{ $i }}" role="tabpanel">
                <p class="service-desc"> <?= $module->description ?> </p>
                @php if (!empty($module->description2)) : @endphp
                <br>
                <p class="service-desc"> <?= $module->description2 ?> </p>
                @php endif @endphp
            </div>
            <div class="tab-pane fade " id="topics{{ $i }}" role="tabpanel">
                @php if (!empty($module->topics)) : @endphp
                    <ul class="ul-item-module">
                        @php foreach($module->topics as $topic): @endphp
                        <li class="li-item-module">
                            <span class="service-tag_">
                                <?= $topic ?>
                            </span>
                        </li>
                        @php endforeach @endphp
                    </ul>
                @php endif @endphp
            </div>
        </div>
    </div>

    <div class="service-techs">
        @php foreach($module->techs as $tech): @endphp
        <span class="service-tag"><?= $tech ?></span>
        @php endforeach @endphp
    </div>

    <div>
        <div class="d-flex justify-content-end">
            <livewire:module-button :module-id="$module->id" :is-user-joined="in_array($module->id, $userModuleIds)"
                                    :key="'module-' . $module->id"/>
        </div>
    </div>
</div>
