<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Class Technology
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $active             Активность (1 = активна, 0 = нет)
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Module[] $modules
 */
class Technology extends Model
{
    protected $fillable = [
        'name',
        'description',
        'active',
    ];

    /**
     * Связь: технология может принадлежать многим модулям (Many-to-Many)
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'module_technology')
            ->withTimestamps();
    }
}
