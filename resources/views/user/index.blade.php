@extends('layouts.main')

@section('title')
    О нас — Мой сайт
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="line"></div>


        <div class="row">
            <?php for ($i = 1; $i < 4; $i++): ?>
            <div class="col-sm-3">
                <div class="item">
                    <div class="item-head">
                        <span class="orange">head</span>
                        <span class="red">123 <span>/123</span> </span>
                    </div>
                    <div class="item-body">
                        <div class="body-top">
                            <div class="container">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="item-name">L-0<?= $i?> </h2>
                                    </div>
                                    <div class="col-5 item-status d-flex flex-column align-items-end gap-1">
                                        <span>r/001-233</span>
                                        <span class="status-boxes d-flex gap-1_">
                                            <div class="box box-yellow"></div>
                                            <div class="box box-orange"></div>
                                            <div class="box box-orange"></div>
                                            <div class="box"></div>
                                            <div class="box"></div>
                                        </span>
                                        <span>127.01.01</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body-middle">
                            <div class="brackets brackets-tl"></div>
                            <div class="brackets brackets-tr"></div>
                            <div class="brackets brackets-bl"></div>
                            <div class="brackets brackets-br"></div>
                            <h2>11 <span class="text-danger">x</span>  </h2>
                        </div>
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
            </div>
            <?php endfor; ?>
            <div class="col-sm-3">
                <div class="item">
                    <div class="circle">
                        <div class="hole"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div>
        <div class="container">
            <h1>1111</h1>
            <div class="row">
                <div class="col-sm-6">
                    qqqq
                </div>
                <div class="col-sm-2 te">
                    qqq
                </div>
                <div class="col-sm-12"></div>
                <p class="text-danger"></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="hex-div">
                        Шестигранный DIV
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="hex-div">
                        Шестигранный DIV
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="hex-div">
                        Шестигранный DIV
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const isDarkTheme = window.matchMedia('(prefers-color-scheme: dark)').matches;
        console.log(isDarkTheme ? 'dark' : 'light');
    </script>
@endsection
