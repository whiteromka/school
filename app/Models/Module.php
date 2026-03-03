<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Module
 *
 * @property int $id
 * @property string $type            Тип модуля (Back | Front | Eng)
 * @property int|null $number        Порядковый номер
 * @property string $name            Название модуля
 * @property int $level              Уровень сложности
 * @property string|null $description
 * @property string|null $description2
 * @property int $active             Активность (1 = активен, 0 = нет)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Technology[] $technologies
 */
class Module extends Model
{
    protected $fillable = [
        'type',
        'number',
        'name',
        'level',
        'description',
        'description2',
        'active',
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
