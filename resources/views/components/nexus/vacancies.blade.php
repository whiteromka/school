@php
    use App\Models\Vacancy;
    /** @var Vacancy[] $vacancies */
    /** @var int $count */
@endphp

<div class="container">
    <div>
        <div class="section-header">
            <div class="section-label" id="js-jobs">jobs</div>
            <h2 class="section-title">Актуальные вакансии</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div>
            {{-- Табы --}}
            <ul class="nav nav-tabs cy-item-tabs fs-13" id="tech" role="tablist" style="display: flex; justify-content: center">
                <li class="nav-item " role="presentation">
                    <button class="nav-link active " data-bs-toggle="tab" data-bs-target="#php" type="button" data-vacancy-type="PHP">
                        php
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#js" type="button" data-vacancy-type="Java Script">
                        java_script
                    </button>
                </li>
            </ul>
            <br>

            {{-- Таб контент --}}
            <div class="tab-content cy-item-tabs-content">
                <div class="tab-pane fade show active" id="php">
                    <div class="row" id="vacancies-container-php">
                        {{--   на js прилетают вакансии PHP--}}
                    </div>

                    <div class="row">
                        <div class="col-12 px-1 d-flex justify-content-end">
                            <button class="btn btn-s btn--secondary" id="loadMoreVacancies-php" data-offset="0" data-type="PHP">
                                <span class="btn__content">Еще PHP вакансии</span>
                                <span class="btn__glitch"></span>
                                <span class="btn__label">r25</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="js">
                    <div class="row" id="vacancies-container-js">
                        {{--   на js прилетают вакансии Java Script--}}
                    </div>

                    <div class="row">
                        <div class="col-12 px-1 d-flex justify-content-end">
                            <button class="btn btn-s btn--secondary" id="loadMoreVacancies-js" data-offset="0" data-type="Java Script">
                                <span class="btn__content">Еще JS вакансии</span>
                                <span class="btn__glitch"></span>
                                <span class="btn__label">r25</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Инициализация для PHP вакансий
        initVacanciesLoader('php', 'PHP');
        // Инициализация для JS вакансий
        initVacanciesLoader('js', 'Java Script');

        function initVacanciesLoader(tabId, type) {
            const container = document.getElementById(`vacancies-container-${tabId}`);
            const button = document.getElementById(`loadMoreVacancies-${tabId}`);
            let offset = parseInt(button.dataset.offset, 10);
            let loading = false;

            function updateOffset(count) {
                offset += count;
                button.dataset.offset = offset;
            }

            // Проверка новых вакансий при загрузке
            async function loadFirstVacancy() {
                try {
                    const response = await fetch(
                        '/vacancy/check?type=' + encodeURIComponent(type),
                        { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
                    );
                    const data = await response.json();
                    if (data.count === 0) return;
                    container.insertAdjacentHTML('afterbegin', data.html);
                    updateOffset(data.count);
                } catch (e) {
                    console.error('Ошибка загрузки вакансий', e);
                }
            }
            loadFirstVacancy();

            // Кнопка "Еще вакансии"
            button.addEventListener('click', async () => {
                if (loading) return;
                loading = true;
                button.disabled = true;
                try {
                    const response = await fetch(
                        '/vacancy/load-more?offset=' + offset + '&type=' + encodeURIComponent(type),
                        { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
                    );
                    const data = await response.json();
                    if (data.count === 0) {
                        button.remove();
                        return;
                    }
                    container.insertAdjacentHTML('beforeend', data.html);
                    updateOffset(data.count);
                } catch (e) {
                    console.error('Ошибка загрузки вакансий', e);
                } finally {
                    loading = false;
                    button.disabled = false;
                }
            });
        }
    });
</script>
@endpush

