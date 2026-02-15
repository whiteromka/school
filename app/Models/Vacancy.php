<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $hh_id
 * @property string $name
 * @property string|null $description
 * @property string|null $area_id
 * @property string|null $area_name
 * @property float|null $salary_from
 * @property float|null $salary_to
 * @property string|null $salary_currency
 * @property bool|null $salary_gross
 * @property string|null $requirement
 * @property string|null $responsibility
 * @property int|null $responses_count
 * @property string|null $experience
 * @property string|null $employment_name
 * @property array|null $key_skills
 * @property Carbon|null $published_at
 * @property Carbon|null $archived_at
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read string|null $salary_range
 * @property-read string $experience_formatted
 */
class Vacancy extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'vacancies';


    protected $guarded = [];

    /**
     * Поля, которые должны быть преобразованы в native типы.
     *
     * @var array
     */
    protected $casts = [
        'salary_from' => 'decimal:0',
        'salary_to' => 'decimal:0',
        'salary_gross' => 'boolean',
        'responses_count' => 'integer',
        'key_skills' => 'array',
        'published_at' => 'datetime:Y-m-d',
        'archived_at' => 'datetime:Y-m-d',
    ];

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? date('Y-m-d', strtotime($value)) : null,
        );
    }

    protected function requirement(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str_replace(['<highlighttext>', '</highlighttext>'], '', $value),
        );
    }

    protected function responsibility(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str_replace(['<highlighttext>', '</highlighttext>'], '', $value),
        );
    }

    public function getPrettySalary(): ?string
    {
        $salary = '';
        if (!$this->salary_from && !$this->salary_to) {
            return '-';
        }

        $parts = [];
        if ($this->salary_from) {
            $parts[] = number_format($this->salary_from, 0, '.', ' ');
        }
        if ($this->salary_to) {
            $parts[] = number_format($this->salary_to, 0, '.', ' ');
        }
        if (isset($parts[0]) && !isset($parts[1])) {
            $salary = 'от ' . $parts[0];
        } else if (isset($parts[1]) && !isset($parts[0])) {
            $salary = 'до ' . $parts[1];
        }

        if (isset($parts[0]) && isset($parts[1])) {
            if ($parts[0] !== $parts[1]) {
                $salary = $parts[0] . ' - ' . $parts[1];
            } else {
                $salary = $parts[0];
            }

        }
        if (!$salary) {
            return '-';
        }
        return $salary . ' ' . $this->salary_currency ?? 'RUR';
    }
}
