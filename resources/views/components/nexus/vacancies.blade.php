@php use App\Models\Vacancy; @endphp
<div class="container px-1_">
    <section class="section_" id="projects">
        <div class="section-header">
            <div class="section-label">jobs</div>
            <h2 class="section-title">Актуальные вакансии</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="row">
            <?php /** @var Vacancy[] $vacancies */ ?>
            @foreach($vacancies as $item)
                <div class="col-12 col-md-6 px-1 d-flex">
                    <div class="project-card w-100 d-flex flex-column">
                        <div class="project-year">
                            {{ $item->published_at }} //
                            {{ $item->area_name }} //
                            <span class="salary">{{ $item->getPrettySalary() }}</span>
                        </div>
                        <div class="project-name">{{ $item->name  }}</div>
                        <div class="project-tech"> {{ $item->requirement  }}</div>
                        <p class="project-desc flex-grow-1">
                            {{ $item->responsibility  }}
                        </p>
                        <div style="display: flex; justify-content: end;">
                            <a class="btn btn-s" href="{{ $item->url }}" target="_blank">
                                <span class="btn__content ">смотреть на hh.ru</span>
                                <span class="btn__glitch"></span>
                                <span class="btn__label">00_xv</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12 px-1">
                <a class="btn btn-s btn--secondary">
                    <span class="btn__content">Скрыть вакансии</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </a>
            </div>
        </div>

    </section>
</div>

