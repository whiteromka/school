@php
    use App\Models\Vacancy;
    /** @var Vacancy[] $vacancies */
@endphp

@foreach($vacancies as $item)
    <div class="col-12 col-md-6 px-1 d-flex vacancy-item">
        <div class="project-card w-100 d-flex flex-column">
            <div class="project-year">
                {{ $item->getShortPublishedAt() }} //
                {{ $item->area_name }} //
                <span class="salary">{{ $item->getPrettySalary() }}</span>
            </div>

            <div class="project-name">{{ $item->name }}</div>
            <div class="project-tech fs-p-small">{{ $item->requirement }}</div>
            <p class="project-desc fs-p-small flex-grow-1 mb-3">
                {{ $item->responsibility }}
            </p>

            <div class="vacancy-tech-list mb-3">
                @foreach($item->key_skills as $skill)
                    <span class="vacancy-tech"> {{ $skill }} </span>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <a class="btn btn-s" href="{{ $item->url }}" target="_blank">
                    <span class="btn__content">смотреть на hh.ru</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">00_xv</span>
                </a>
            </div>
        </div>
    </div>
@endforeach
