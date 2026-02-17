@php
    /** @var string $userIp */
@endphp

@extends('layouts.main')

@section('title', 'Групповые курсы по программированию')

@section('content')
{{-- Вступительный контейнер    --}}
<x-cyber.main-first :userIp="$userIp"></x-cyber.main-first>
<br>
<br>
<br>
<br>

<x-ico-tech></x-ico-tech>

{{--  Контейнер преимущества  --}}
<x-cyber.advantages></x-cyber.advantages>
<br>
<br>
<br>
<br>
<br>

{{-- ========  ABOUT =========--}}
<x-nexus.about></x-nexus.about>
<br>
<br>
<br>
<br>
<br>

{{--  FAQ на основе col из бутстрапа  --}}
<x-cyber.faq-col></x-cyber.faq-col>
<div style="height: 150px"></div>


{{-- Двойной контейнер с 3d визуализацией --}}
<x-cyber.perspective3d></x-cyber.perspective3d>


{{-- Контейнер network с технологиями --}}
<x-network.network-wrapper></x-network.network-wrapper>
<div style="height: 120px"></div>


{{-- Контейнер с курсами \ модулями (items)  --}}
<x-cyber.items></x-cyber.items>
<br>
<br>


<x-nexus.vacancies></x-nexus.vacancies>
<br>
<br>
<br>

<x-footer-dark></x-footer-dark>
{{--    <x-footer></x-footer>--}}
<br>
<br>
<br>


{{-- Обычный двойной Контейнер --}}
<x-cyber.simple-double></x-cyber.simple-double>
<br>
<br>
<br>
<br>


<x-nexus></x-nexus>
@endsection
