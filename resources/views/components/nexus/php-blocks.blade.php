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
            <h2 class="section-title">Модули курса BACKEND</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="row mb-10">
            <div class="col-12">
                @include('components.frameshift.info-panel')
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-2">
                @php
                    $i = 1;
                    /** @var App\Models\Module $module */
                    foreach($modules as $module):
                @endphp
                @include('components.nexus.module', ['max' => 94, 'i' => $i, 'module' => $module])
                @php
                    $i++;
                    endforeach
                @endphp
            </div>
        </div>
    </section>
</div>
