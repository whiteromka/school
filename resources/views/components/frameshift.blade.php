@php
//  ['name' => 'Front', 'label' => 'JS', 'css' => 'bg-JS', 'crew' => 14, 'img' => '...',]
/** @var array $course */
@endphp

<div class="interface-container">
    <div class="grid-overlay"></div>

    <div class="corner-dot-group tl">:::</div>
    <div class="corner-dot-group tr">:::</div>
    <div class="corner-dot-group bl">:::</div>
    <div class="corner-dot-group br">:::</div>

    <div class="side-text side-left">{{ $course['name'] }} DIGITAL MODULE XX 00 00 2026</div>
    <div class="side-text side-right">DIGITAL MODULE XX 00 00 2026 {{ $course['name'] }}</div>

    <div class="top-section">
        <div class="top-header">
            <span>FRAMESHIFT</span>
            <span><span class="blink">●</span> <span class="js-top-code">00555985 AA</span></span>
        </div>

        <div class="data-bar">
            <span>001</span>
            <span class="js-random-number">9022566874113</span>
            <span>C</span>
        </div>

        <div class="status-block">
            <div><span>STATUS:</span> {{ $course['name'] }} REGENERATING</div>
            <div><span>STATUS:</span> GENERATING DATA PROCESSING</div>
            <div><span>MODE:</span> SECURE CONNECTION</div>
        </div>
    </div>

    <div class="center-section">
        <div class="loading-title-container">
            <div class="loading-line"></div>
            <div class="loading-text">{{ $course['name'] }}<br>LOADING SYSTEM</div>
        </div>
    </div>

    <div class="bottom-section">
        <div class="progress-block">
            <div class="progress-fill"></div>
        </div>
        <div class="main-title">{{ $course['name'] }}</div>
        <div class="sub-title">SYSTEM DATA LOADING MODULE</div>
        <div class="code-number">800 122 554</div>
    </div>

    <div class="bottom-circles">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
</div>

