<?php

namespace App\Livewire;

use App\Models\Vacancy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Вакансии')]
class VacancyFilter extends Component
{
    use WithPagination;

    #[Url]
    public string $name = '';

    #[Url]
    public string $type = '';

    #[Url(as: 'salary_from')]
    public string $salaryFrom = '';

    #[Url(as: 'salary_to')]
    public string $salaryTo = '';

    #[Url(as: 'salary_currency')]
    public string $salaryCurrency = '';

    #[Url]
    public int $page = 1;

    public int $perPage = 15;

    protected function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:2', 'max:255'],
            'type' => ['nullable', 'string'],
            'salaryFrom' => ['nullable', 'integer', 'min:0'],
            'salaryTo' => ['nullable', 'integer', 'min:0'],
            'salaryCurrency' => ['nullable', 'string'],
        ];
    }

    public function updated($property): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->name = '';
        $this->type = '';
        $this->salaryFrom = '';
        $this->salaryTo = '';
        $this->salaryCurrency = '';
        $this->page = 1;
    }

    private function filterVacancies(): LengthAwarePaginator
    {
        $query = Vacancy::query();

        if (!empty($this->name)) {
            $query->where('name', 'like', "%{$this->name}%");
        }

        if (!empty($this->type)) {
            $query->where('type', $this->type);
        }

        if (!empty($this->salaryFrom)) {
            $query->where('salary_from', '>=', (int) $this->salaryFrom);
        }

        if (!empty($this->salaryTo)) {
            $query->where('salary_to', '<=', (int) $this->salaryTo);
        }

        if (!empty($this->salaryCurrency)) {
            $query->where('salary_currency', $this->salaryCurrency);
        }

        return $query
            //->orderBy('salary_from', 'desc')
            ->paginate($this->perPage);
    }

    private function getCurrencies(): array
    {
        return Vacancy::getUniqueCurrencies();
    }

    public function render()
    {
        return view('livewire.vacancy-filter', [
            'vacancies' => $this->filterVacancies(),
            'currencies' => $this->getCurrencies(),
        ]);
    }
}
