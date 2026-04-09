@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
    /** @var int[] $userModuleIds */
    $max = 94;
@endphp

<div class="container">
    <section>
        <div class="section-header">
            <div class="section-label">Modules</div>
            <h2 class="section-title">Модули курса GAMEDEV</h2>
            <div class="section-divider"></div>
        </div>

        <div class="row mb-10">
            <div class="col-12">
                @php $txt = "
                    Друзья мы не являемся профессиональными разработчиками в области gamedev-а.
                    Тем не менее у нас есть некоторые перспективные проекты которые мы ведем и развиваем самостоятельно,
                    и возможно вам они тоже покажутся интересными... Первые уроки как всегда бесплатные для всех!";
                @endphp
                @include('components.frameshift.info-panel', ['text' => $txt])
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-2">
                @php
                    $i = 1;
                    /** @var App\Models\Module $module */
                    foreach($modules as $module):
                @endphp
                @include('components.nexus.module', ['max'=>94, 'i' => $i, 'module' => $module])
                @php
                    $i++;
                    endforeach
                @endphp
            </div>
        </div>
    </section>
</div>

