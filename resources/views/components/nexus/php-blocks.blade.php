@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
@endphp

<div class="container">
    <section class="section_" id="services">
        <div class="section-header">
            <div class="section-label">Modules</div>
            <h2 class="section-title">Модули курса BACKEND</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="row mb-10">
            <div class="col-12">
                <div class="js-cy-brackets warning " data-color="red" data-size="8" data-width="1">
                    <span class="orange">Warning!</span> Первые уроки каждого модуля бесплатные! Для посещения последующих нужно будет оплатить модуль
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @php
                    $i = 1;
                    /** @var App\Models\Module $module */
                    foreach($modules as $module):
                @endphp
                <div class="service-card course-module mb-1">
                    <div class="service-index">
                        <div class="left"> 0<?= $i ?></div>
                        <div class="right">
                          <div>
                              <span><span class="orange_"><?= $module->lesson_price ?> RUR</span> за урок</span>
                              <span><span class="cyan_"><?= $module->duration ?></span></span>
                              <span><span class="cyan_"><?= $module->count_lessons ?></span> уроков</span>
                              <span><span class="cyan_"><?= $module->level ?> / 10 </span> сложность</span>
                          </div>
                        </div>
                    </div>
                    <div class="service-name">
                        <?= $module->name ?>
                        <span class="dark-gey"> / </span>
                        <span class="orange"> <?= $module->module_price ?> RUR </span>
                    </div>



                    <div class="php-tabs-wrapper_">
                        <ul class="nav nav-tabs cy-item-tabs" id="a{{ $i }}" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#text{{ $i }}" type="button" aria-selected="true" role="tab">
                                    Описание
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " data-bs-toggle="tab" data-bs-target="#topics{{ $i }}" type="button" aria-selected="false" tabindex="-1" role="tab">
                                    Темы модуля
                                </button>
                            </li>

                        </ul>

                        <div class="tab-content cy-item-tabs-content">
                            <div class="tab-pane fade show active" id="text{{ $i }}" role="tabpanel">
                                <p class="service-desc"> <?= $module->description ?> </p>
                                @php if (!empty($module->description2)) : @endphp
                                <br>
                                <p class="service-desc"> <?= $module->description2 ?> </p>
                                @php endif @endphp
                            </div>
                            <div class="tab-pane fade " id="topics{{ $i }}" role="tabpanel">
                                @php if (!empty($module->topics)) : @endphp
                                    @php foreach($module->topics as $topic): @endphp
                                    <ul class="ul-item-module">
                                        <li class="li-item-module"> <span class="service-tag_"><?= $topic?></span></li>
                                    </ul>
                                    @php endforeach @endphp
                                @php endif @endphp
                            </div>
                        </div>
                    </div>

                    <div class="service-techs">
                        @php foreach($module->techs as $tech): @endphp
                        <span class="service-tag"><?= $tech?></span>
                        @php endforeach @endphp
                    </div>

                    <div>
                        <div class="d-flex justify-content-end">
{{--                            <button class="btn btn-s" >--}}
{{--                                <span class="btn__content">Посмотреть темы</span>--}}
{{--                                <span class="btn__glitch"></span>--}}
{{--                                <span class="btn__label">00_xv</span>--}}
{{--                            </button>--}}

                            <button class="btn btn-s btn--secondary">
                                <span class="btn__content">Записаться бесплатно</span>
                                <span class="btn__glitch"></span>
                                <span class="btn__label">r25</span>
                            </button>

                        </div>
                    </div>
                </div>
                @php
                    $i++;
                    endforeach
                @endphp
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceCards = document.querySelectorAll('.service-card');

            serviceCards.forEach(card => {
                let hoverTimeout;
                let spanTimeouts = [];
                let colorTimeout;

                card.addEventListener('mouseenter', function() {
                    const rightDiv = card.querySelector('.right > div');
                    const spans = rightDiv ? rightDiv.querySelectorAll('span span') : [];

                    hoverTimeout = setTimeout(() => {
                        if (rightDiv) {
                            rightDiv.style.borderLeft = '1px dotted #00f0ff';
                            rightDiv.style.transition = 'all 0.3s ease';
                        }

                        spans.forEach((span, index) => {
                            const spanTimeout = setTimeout(() => {
                                const currentClass = span.className;
                                const newClass = currentClass.replace('_', '');
                                span.className = newClass;
                            }, 400 + (index * 100));
                            spanTimeouts.push(spanTimeout);
                        });

                        // смена цвета после всех span
                        colorTimeout = setTimeout(() => {
                            if (rightDiv) {
                                rightDiv.style.color = '#8b8b8b';
                            }
                        }, 900);

                    }, 400);
                });

                card.addEventListener('mouseleave', function() {
                    clearTimeout(hoverTimeout);
                    spanTimeouts.forEach(timeout => clearTimeout(timeout));
                    spanTimeouts = [];
                    clearTimeout(colorTimeout);

                    const rightDiv = card.querySelector('.right > div');
                    const spans = rightDiv ? rightDiv.querySelectorAll('span span') : [];

                    if (rightDiv) {
                        rightDiv.style.borderLeft = '';
                        rightDiv.style.paddingLeft = '';
                        rightDiv.style.color = '#343434';
                    }

                    spans.forEach(span => {
                        const currentClass = span.className;
                        if (!currentClass.includes('_')) {
                            span.className = currentClass + '_';
                        }
                    });
                });
            });
        });
    </script>
@endpush
