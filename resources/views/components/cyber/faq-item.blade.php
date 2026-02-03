<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="row">

                @for($i = 1; $i <= 10; $i++)
                    <div class="col-12 faq-item px-0">
                        <div class="faq-item-left">
                            <div class="faq-item-part1">
                                <span>0.{{ $i }}</span>
                            </div>
                        </div>
                        <div class="faq-item-content">
                            <span>Кто преподает на курсах?</span>
                        </div>
                        <div class="faq-item-right">
                            <div class="faq-item-part1">
                                <span></span>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </div>
</div>
