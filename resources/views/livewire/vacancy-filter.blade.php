@php
    use Illuminate\Pagination\LengthAwarePaginator;

    /** @var  LengthAwarePaginator $vacancies */
    /** @var array $currencies */
@endphp

<div class="container py-5">
    <h1 class="mb-4">Вакансии</h1>

    <!-- Форма фильтрации -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Фильтры</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="$refresh" class="row g-3">

                <!-- Поиск по названию -->
                <div class="col-md-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           wire:model.live.debounce.300ms="name"
                           placeholder="По названию">
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <!-- Тип вакансии -->
                <div class="col-md-3">
                    <label for="type" class="form-label">Тип</label>
                    <select class="form-select" id="type" wire:model.live="type">
                        <option value="">Все</option>
                        <option value="PHP">PHP</option>
                        <option value="Java Script">Java Script</option>
                        <option value="C#">C#</option>
                    </select>
                </div>

                <!-- Зарплата от -->
                <div class="col-md-2">
                    <label for="salary_from" class="form-label">ЗП от</label>
                    <input type="number"
                           class="form-control"
                           id="salary_from"
                           wire:model.live.debounce.300ms="salaryFrom"
                           placeholder="50000">
                    @error('salaryFrom') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <!-- Зарплата до -->
                <div class="col-md-2">
                    <label for="salary_to" class="form-label">ЗП до</label>
                    <input type="number"
                           class="form-control"
                           id="salary_to"
                           wire:model.live.debounce.300ms="salaryTo"
                           placeholder="350000">
                    @error('salaryTo') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <!-- Зарплата до -->
                {{--                <div class="col-md-2">--}}
                {{--                    <label for="salary_currency" class="form-label">ЗП до</label>--}}
                {{--                    <input type="string"--}}
                {{--                           class="form-control"--}}
                {{--                           id="salary_currency"--}}
                {{--                           wire:model.live.debounce.300ms="salaryCurrency"--}}
                {{--                           placeholder="350000">--}}
                {{--                    @error('salaryCurrency') <span class="text-danger small">{{ $message }}</span> @enderror--}}
                {{--                </div>--}}
                <!-- Тип вакансии -->
                <div class="col-md-2">
                    <label for="type" class="form-label">Тип</label>
                    <select class="form-select" id="salary_currency" wire:model.live="salaryCurrency">
                        <option value="">Все</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Кнопки -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Найти
                    </button>
                    <button type="button" class="btn btn-outline-secondary" wire:click="resetFilters">
                        <i class="bi bi-x-circle"></i> Сбросить
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Таблица вакансий -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 25%">Название</th>
                <th style="width: 10%">Тип</th>
                <th style="width: 15%">Зарплата</th>
                <th style="width: 15%">Город</th>
                <th style="width: 10%">Опыт</th>
                <th style="width: 10%">Откликов</th>
                <th style="width: 10%">Дата</th>
            </tr>
            </thead>
            <tbody>
            @forelse($vacancies as $vacancy)
                <tr>
                    <td>{{ $vacancy->id }}</td>
                    <td>
                        <a href="{{ $vacancy->url }}" target="_blank" class="text-decoration-none">
                            {{ Str::limit($vacancy->name, 60) }}
                        </a>
                    </td>
                    <td>
                            <span
                                class="badge bg-{{ $vacancy->type === 'Back' ? 'primary' : ($vacancy->type === 'Front' ? 'success' : 'info') }}">
                                {{ $vacancy->type }}
                            </span>
                    </td>
                    <td>{{ $vacancy->getPrettySalary() }}</td>
                    <td>{{ $vacancy->area_name ?? '-' }}</td>
                    <td>{{ $vacancy->experience_formatted ?? '-' }}</td>
                    <td>{{ $vacancy->responses_count ?? 0 }}</td>
                    <td>{{ $vacancy->getShortPublishedAt() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Вакансии не найдены</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Информация о количестве -->
    <div class="text-muted text-center mt-3 bg-white">
        Найдено: {{ $vacancies->total() }} |
        Страница {{ $vacancies->currentPage() }} из {{ $vacancies->lastPage() }}
    </div>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center mt-4">
        {{ $vacancies->links('livewire.pagination') }}
    </div>


</div>
