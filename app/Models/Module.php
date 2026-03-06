<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Class Module
 *
 * @property int $id
 * @property string $type            Тип модуля (Back | Front | Eng)
 * @property int|null $number        Порядковый номер
 * @property string $name            Название модуля
 * @property int $level              Уровень сложности
 * @property int $module_price
 * @property int $lesson_price
 * @property $topics                  Темы модуля
 * @property $techs                   Технологии
 * @property string $duration
 * @property int $count_lessons
 * @property string|null $description
 * @property string|null $description2
 * @property int $active             Активность (1 = активен, 0 = нет)
 * @property string $author
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Technology[] $technologies
 */
class Module extends Model
{
    const AUTHOR_ROMAN = 'Roman Belov';
    const AUTHOR_ILIAH = 'Iliah Udin';

    protected $fillable = [
        'type',
        'number',
        'name',
        'level',
        'module_price',
        'lesson_price',
        'topics',
        'techs',
        'duration',
        'count_lessons',
        'description',
        'description2',
        'author',
        'active',
    ];

    protected $casts = [
        'techs' => 'array',
        'topics' => 'array',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь: один модуль может иметь много технологий (Many-to-Many)
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'module_technology')
            ->withTimestamps();
    }
}
