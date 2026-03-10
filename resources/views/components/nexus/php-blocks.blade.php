@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
    /** @var int[] $userModuleIds */
@endphp

<div class="container">
    <section>
        <div class="section-header">
            <div class="section-label">Modules</div>
            <h2 class="section-title">Модули курса BACKEND</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="row mb-10">
            <div class="col-12">
                <div class="js-cy-brackets warning " data-color="red" data-size="8" data-width="1">
                    <span class="orange">Warning!</span> Первые уроки каждого модуля бесплатные! Для посещения
                    последующих нужно будет оплатить модуль
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#text{{ $i }}"
                                        type="button" aria-selected="true" role="tab">
                                    Описание
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " data-bs-toggle="tab" data-bs-target="#topics{{ $i }}"
                                        type="button" aria-selected="false" tabindex="-1" role="tab">
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
                                    <li class="li-item-module"><span class="service-tag_"><?= $topic ?></span></li>
                                </ul>
                                @php endforeach @endphp
                                @php endif @endphp
                            </div>
                        </div>
                    </div>

                    <div class="service-techs">
                        @php foreach($module->techs as $tech): @endphp
                        <span class="service-tag"><?= $tech ?></span>
                        @php endforeach @endphp
                    </div>

                    <div>
                        <div class="d-flex justify-content-end">

                            @if(in_array($module->id, $userModuleIds))
                                <div class="btn btn-s btn--success c-d">
                                    <span class="btn__content">Вы записаны</span>
                                    <span class="btn__glitch_"></span>
                                    <span class="btn__label_">r25</span>
                                </div>

                                <button data-module-id="{{ $module->id }}"
                                   data-action="leave"
                                   class="btn btn-s btn--secondary module-action-btn"
                                >
                                    <span class="btn__content">Выписаться</span>
                                    <span class="btn__glitch"></span>
                                    <span class="btn__label">r25</span>
                                </button>
                            @else
                                <button data-module-id="{{ $module->id }}"
                                   data-action="join"
                                   class="btn btn-s module-action-btn"
                                >
                                    <span class="btn__content">Записаться бесплатно</span>
                                    <span class="btn__glitch"></span>
                                    <span class="btn__label">r25</span>
                                </button>
                            @endif

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
        document.addEventListener('DOMContentLoaded', function () {
            // Hover-эффекты для карточек
            document.querySelectorAll('.service-card').forEach(card => {
                let hoverTimeout, spanTimeouts = [], colorTimeout;

                card.addEventListener('mouseenter', () => {
                    const rightDiv = card.querySelector('.right > div');
                    const spans = rightDiv?.querySelectorAll('span span') || [];

                    hoverTimeout = setTimeout(() => {
                        if (rightDiv) {
                            rightDiv.style.borderLeft = '1px dotted #00f0ff';
                            rightDiv.style.transition = 'all 0.3s ease';
                        }

                        spans.forEach((span, index) => {
                            spanTimeouts.push(setTimeout(() => {
                                span.className = span.className.replace('_', '');
                            }, 400 + (index * 100)));
                        });

                        colorTimeout = setTimeout(() => {
                            if (rightDiv) rightDiv.style.color = '#8b8b8b';
                        }, 900);
                    }, 400);
                });

                card.addEventListener('mouseleave', () => {
                    clearTimeout(hoverTimeout);
                    spanTimeouts.forEach(clearTimeout);
                    spanTimeouts = [];
                    clearTimeout(colorTimeout);

                    const rightDiv = card.querySelector('.right > div');
                    const spans = rightDiv?.querySelectorAll('span span') || [];

                    if (rightDiv) {
                        rightDiv.style.borderLeft = '';
                        rightDiv.style.paddingLeft = '';
                        rightDiv.style.color = '#343434';
                    }

                    spans.forEach(span => {
                        if (!span.className.includes('_')) {
                            span.className += '_';
                        }
                    });
                });
            });

            // Обработчик клика по кнопке
            async function handleModuleAction(e) {
                e.preventDefault();

                const moduleId = this.dataset.moduleId;
                const action = this.dataset.action;

                if (!moduleId || !action) return;

                this.disabled = true;
                this.classList.add('disabled');

                try {
                    const response = await fetch(`/active-module/${action}/${moduleId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? ''
                        },
                        credentials: 'same-origin'
                    });

                    if (response.status === 401) {
                        window.location.href = '/login';
                        return;
                    }

                    const data = await response.json();

                    if (!data.success) {
                        alert(data.message || 'Произошла ошибка');
                        return;
                    }

                    updateModuleButtons(moduleId, data.action);

                } catch (error) {
                    console.error('Error:', error);
                    alert('Произошла ошибка при выполнении операции');
                } finally {
                    this.disabled = false;
                    this.classList.remove('disabled');
                }
            }

            // Обновление кнопок для модуля
            function updateModuleButtons(moduleId, action) {
                const card = document.querySelector(`[data-module-id="${moduleId}"]`)?.closest('.service-card');
                if (!card) return;

                const buttonsContainer = card.querySelector('.d-flex');
                if (!buttonsContainer) return;

                if (action === 'joined') {
                    buttonsContainer.innerHTML = `
                        <div class="btn btn-s btn--success c-d">
                            <span class="btn__content">Вы записаны</span>
                            <span class="btn__glitch_"></span>
                            <span class="btn__label_">r25</span>
                        </div>
                        <button data-module-id="${moduleId}"
                                data-action="leave"
                                class="btn btn-s btn--secondary module-action-btn">
                            <span class="btn__content">Выписаться</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">r25</span>
                        </button>
                    `;
                } else {
                    buttonsContainer.innerHTML = `
                        <button data-module-id="${moduleId}"
                                data-action="join"
                                class="btn btn-s module-action-btn">
                            <span class="btn__content">Записаться бесплатно</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">r25</span>
                        </button>
                    `;
                }

                const newButton = buttonsContainer.querySelector('.module-action-btn');
                if (newButton) {
                    newButton.addEventListener('click', handleModuleAction);
                }
            }

            // Инициализация обработчиков на кнопках
            document.querySelectorAll('.module-action-btn').forEach(button => {
                button.addEventListener('click', handleModuleAction);
            });
        });
    </script>
@endpush
