@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
    /** @var int[] $userModuleIds */
@endphp

@extends('layouts.main')

@section('title', 'Уроки по 3d моделированию, Unity и C#')

@section('content')

    @include('components.nexus.hello-gamedev')

    @include('components.cyber.gamedev-adv')

    <div style="height: 150px"></div>

    @include('components.nexus.gamedev-blocks', ['modules' => $modules, 'userModuleIds' => $userModuleIds])

    <div class="container">
        <br>
        <div class="ta-r">
            <p>Преподаватель модулей: <a href="#">Roman Belov</a></p>
        </div>
    </div>

    <div class="container">
        @include('components.cyber.teacher')
    </div>

    <div style="height: 150px"></div>
@endsection
