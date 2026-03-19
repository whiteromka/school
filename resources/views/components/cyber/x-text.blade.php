<?php
    $main = !empty($main) ? $main : 'HOST';
    $mainSpan = !empty($mainSpan) ? $mainSpan : '---- YYC';
    $descr = !empty($descr) ? $descr : 'xx.xx 1067.34'
?>
<div class="xtext-wrapper d-none d-xxl-block">
    <div class="xtext">
        <span>
            <b>{{ $main }}</b>
            <i>{{ $mainSpan }}</i>
        </span>
        <span class="xtext-border">
            {{ $descr }}
        </span>
    </div>
</div>
