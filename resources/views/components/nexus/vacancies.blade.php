@php
    use App\Models\Vacancy;
    /** @var Vacancy[] $vacancies */
    /** @var int $count */
@endphp

<div class="container px-1_">
    <section class="section_" id="projects">
        <div class="section-header">
            <div class="section-label" id="js-jobs">jobs</div>
            <h2 class="section-title">Актуальные вакансии</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="row" id="vacancies-container">
            {{-- на js прилетают вакансии --}}
        </div>

        <div class="row">
            <div class="col-12 px-1 d-flex justify-content-end">
                <button
                    class="btn btn-s btn--secondary"
                    id="loadMoreVacancies"
                    data-offset="0"
                >
                    <span class="btn__content">Еще вакансии</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </button>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const container = document.getElementById('vacancies-container');
        const button = document.getElementById('loadMoreVacancies');
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
                    '/vacancy/check',
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
                    '/vacancy/load-more?offset=' + offset,
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
    });
</script>
@endpush

