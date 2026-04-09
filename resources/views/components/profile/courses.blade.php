@php

/** @var \App\Models\User $user */
@endphp
<div class="data-panel" data-panel-id="courses">
    @include('components.profile._profile-data-head', ['name' => 'Ваши курсы'])
    <div class="data-panel__body data-stream container">

        @php $i = 1; @endphp
        @foreach($user->activeModules as $activeModule)

            @include('components.nexus.profile-module', [
                'max' => 94,
                'i' => $i,
                'module' => $activeModule->module,
                'activeModule' => $activeModule
            ])

            @php $i++; @endphp
        @endforeach

    </div>
</div>
