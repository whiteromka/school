<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Technology[] $technologies
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
     * Связь: один модуль имеет много технологий
     */
    public function technologies(): HasMany
    {
        return $this->hasMany(Technology::class);
    }
}
