<?php

namespace App\Services\HH;

use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Http;

class HHService implements HHInterface
{
    private const int COUNT_ITEMS = 50;
    public const string TYPE_PHP = 'PHP';
    public const string TYPE_JS = 'JS';

    private string $type;

    public function __construct(string $type = self::TYPE_PHP)
    {
        $this->type = $type;
    }

    /**
     * Получить вакансии с hh.ru и сохранить в БД
     */
    public function fetchVacancies(string $type = 'PHP'): void
    {
        $types = [self::TYPE_PHP, self::TYPE_JS];

        foreach ($types as $type) {
            $this->type = $type;
            $response = Http::get('https://api.hh.ru/vacancies', [
                'text' => $this->type,
                'per_page' => self::COUNT_ITEMS,
                'order_by' => 'publication_time',
                'search_field' => 'name',
            ]);

            // Получаем данные
            $dataVacancies = $response->json();
            $this->saveVacancies($dataVacancies);
        }
    }

    private function saveVacancies(array $data): void
    {
        $uniqueItems = $this->clearData($data);
        foreach ($uniqueItems as $item) {
            $name = $item['name'];
            $responsibility = $item['snippet']['responsibility'];

            try {
                Vacancy::query()->updateOrCreate(
                    ['hh_id' => $item['id']],
                    [
                        'type' => $this->type,
                        'name' => $name,
                        'area_id' => $item['area']['id'] ?? null,
                        'area_name' => $item['area']['name'] ?? null,
                        'salary_from' => $item['salary']['from'] ?? null,
                        'salary_to' => $item['salary']['to'] ?? null,
                        'salary_currency' => $item['salary']['currency'] ?? null,
                        'salary_gross' => $item['salary']['gross'] ?? null,
                        'requirement' => $item['snippet']['requirement'] ?? null,
                        'responsibility' => $responsibility,
                        'experience' => $item['experience']['id'] ?? null,
                        'employment_name' => $item['employment']['name'] ?? null,
                        'published_at' => isset($item['published_at'])
                            ? Carbon::parse($item['published_at'])
                            : null,
                        'archived_at' => isset($item['archived_at'])
                            ? Carbon::parse($item['archived_at'])
                            : null,
                        'url' => $item['alternate_url'] ?? null,
                    ]
                );
            } catch (QueryException $e) {
                if ($e->getCode() === '23000') { // это дубль в БД по ограничениям на уникальность
                  continue; // пропускаем и берем на обработку следующую вакансию
                }

                logger()->error('Vacancy save failed', [
                    'hh_id' => $item['id'] ?? null,
                    'error' => $e->getMessage(),
                ]);
                continue;
            }
        }
    }

    /**
     * Убираем дубли внутри $items (name + responsibility)
     *
     * @param array $items
     * @return array
     */
    private function clearData(array $items): array
    {
        $uniqueItems = [];
        $seen = [];
        foreach ($items['items'] as $item) {
            $name = $item['name'] ?? null;
            $responsibility = $item['snippet']['responsibility'] ?? null;
            if (!$name || !$responsibility) {
                continue;
            }
            $item['snippet']['requirement'] = str_replace(['<highlighttext>', '</highlighttext>'], '', $item['snippet']['requirement']);
            $item['snippet']['responsibility'] = str_replace(['<highlighttext>', '</highlighttext>'], '', $item['snippet']['responsibility']);

            $key = md5($name . '|' . $responsibility);
            if (isset($seen[$key])) {
                continue; // дубль
            }
            $seen[$key] = true;
            $uniqueItems[] = $item;
        }
        return $uniqueItems;
    }

}
