@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
@endphp

@extends('layouts.main')

@section('title', 'Курсы по программированию на php')

@section('content')

    <x-nexus.hello></x-nexus.hello>

    <x-cyber.php-adv></x-cyber.php-adv>

    <x-nexus.php-blocks :modules="$modules"></x-nexus.php-blocks>

    <div class="container">
        <br>
        <div class="ta-r">
            <p>Преподаватель модулей: <a href="#">Roman Belov</a></p>
        </div>
    </div>

    <div class="container">
        <div class="persp-1600">
            <div class="custom-block_persp" style="max-width: 280px;">
                <div class="trapezoid-bottom_persp"></div>
                <div class="php-custom-block-content_persp ta-c" style="min-height: 180px">
                    <img src="http://localhost:8080/img/site/fly_red.jpeg" class="img-fluid" alt="">
                    <p class="php-custom-block-help_persp">преподаватель:</p>
                    <a href="#" class="php-custom-block-head_persp">Roman Belov</a>
                </div>
                <div class="trapezoid-top_persp"></div>
            </div>
        </div>
    </div>

    <div style="height: 150px"></div>
@endsection
