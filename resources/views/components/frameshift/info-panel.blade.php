@php
/** @var string $name */
/** @var string $text */

if (!isset($name)) {
    $name = 'INFO';
}
if (!isset($text)) {
    $text = 'Warning! Первые уроки каждого модуля бесплатные! Для посещения последующих
       нужно будет оплатить модуль';
}
@endphp
<div class="data-block">
    <div class="progress-markers">
        <div class="progress-marker"></div>
        <div class="progress-line-bottom"></div>
        <div class="progress-marker"></div>
    </div>
    <div class="side-text side-left d-block">||||||||||</div>
    <div class="side-text side-right d-block">||||||||||</div>
    <div class="data-main">
        <span class="num-inf">{{ $name }}</span>
    </div>
    <div class="progress-markers">
        <div class="progress-marker"></div>
        <div class="progress-line-bottom"></div>
        <div class="progress-marker"></div>
    </div>

    <div class="loading-section mt-2">
        <div class="loading-header ta-c">
            <span class="loading-text-code1 ta-c_">
                <span class="pink2  ta-c_">
                    {{ $text }}
                </span>
            </span>
        </div>
    </div>
</div>
