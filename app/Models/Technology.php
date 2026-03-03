<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Technology
 *
 * @property int $id
 * @property int $module_id          ID модуля
 * @property string $name            Название технологии
 * @property string|null $description
 * @property int $active             Активность (1 = активна, 0 = нет)
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Module $module
 */
class Technology extends Model
{
    protected $fillable = [
        'module_id',
        'name',
        'description',
        'active',
    ];

    /**
     * Связь: технология принадлежит модулю
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
