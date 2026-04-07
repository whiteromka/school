@php
//  ['name' => 'Front', 'label' => 'JS', 'css' => 'bg-JS', 'crew' => 14, 'img' => '...',]
//      'tabs' => [
//          'promo'=>'...',
//      ]
//  ]
/** @var array $course */
@endphp

<div class="interface-container">
    <div class="grid-overlay_"></div>

    <div class="corner-dot-group tl">:::</div>
    <div class="corner-dot-group tr">:::</div>
    <div class="corner-dot-group bl">:::</div>
    <div class="corner-dot-group br">:::</div>

    <div class="side-text side-left d-block">||||||||||||||||||||||</div>
    <div class="side-text side-right d-block">||||||||||||||||||||||</div>

    <div class="top-section">
        <div class="top-header">
            <span>COMMAND</span>
            <span>
                <span class="js-top-code">00555985 AA</span>
            </span>
        </div>

        <div class="data-bar">
            <span>00.X</span>
            <span class="js-random-number">9022566874113</span>
            <span>C</span>
        </div>

        <div class="status-block">
            <div class="fs-14 ta-c">Technology: {{ $course['label'] }}</div>
{{--            <div><span>STATUS:</span> GENERATING DATA PROCESSING</div>--}}
{{--            <div><span>MODE:</span> SECURE CONNECTION</div>--}}
        </div>
    </div>

    <div class="center-section">
        <div class="grid-overlay"></div>
        <div class="loading-title-container">
            <div class="sub-title">
                {{ $course['tabs']['promo'] }}
            </div>
        </div>
    </div>

    <div class="bottom-section">
        <div class="progress-block">
            <div class="progress-fill"></div>
        </div>
        <div class="js-main-title main-title tt-up">{{ $course['name'] }}</div>
        <div class="sub-title ta-c">SYSTEM DATA LOADING MODULE</div>
        <div class="code-number">800 122 554</div>
    </div>

    <div class="bottom-circles">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
</div>

