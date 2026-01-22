@extends('layouts.main')

@section('title')
    О нас — Мой сайт
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a class="js-cyber-text-animation cy-btn">press to login</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">

{{--        <div class="row">--}}
{{--            <div class="col-7" >--}}
{{--                <x-network></x-network>--}}
{{--            </div>--}}
{{--        </div>--}}

        <br>
        <div class="line"></div>
        <div class="row">
            <?php for ($i = 1; $i <= 3; $i++): ?>
            {{-- Основная карточка начало --}}
            <div class="col-sm-4">
                <div class="item">
                    <div class="item-head">
                        <span class="orange">head</span>
                        <span class="red">123 <span>/123</span> </span>
                    </div>
                    <div class="item-body">
                        <div class="body-top">
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 cntr">
                                        <p class="item-name">cell   <span>0.00<?= $i?> </span></p>
                                    </div>
                                    <div class="col-5 item-status d-flex flex-column align-items-end gap-1">
                                        <span>r/001-233</span>
                                        <span>127.01.01</span>
                                        <span class="status-boxes d-flex gap-1_">
                                            <div class="box box-yellow"></div>
                                            <div class="box box-orange"></div>
                                            <div class="box box-orange"></div>
                                            <div class="box"></div>
                                            <div class="box"></div>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Основная карточка body-middle --}}
                        <div class="body-middle">
                            <div class="brackets brackets-tl"></div>
                            <div class="brackets brackets-tr"></div>
                            <div class="brackets brackets-bl"></div>
                            <div class="brackets brackets-br"></div>
{{--                            <x-floppy />--}}
{{--                            <x-test></x-test>--}}
{{--                            <x-led></x-led>--}}
                        </div> {{-- Основная карточка body-middle конец --}}
                        <div class="body-bottom">
                            footer
                            <div class="loader">
                                <div class="inloader inl-0"></div>
                                <div class="inloader inl-1"></div>
                            </div>
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div> {{-- Основная карточка конец --}}
            <?php endfor; ?>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="empty-div"></div>
            </div>

            <div class="col-12">
                <div class="empty-div2"></div>
            </div>
        </div>
    </div>


    {{--    <script>--}}
{{--        const isDarkTheme = window.matchMedia('(prefers-color-scheme: dark)').matches;--}}
{{--        console.log(isDarkTheme ? 'dark' : 'light');--}}
{{--    </script>--}}
@endsection
