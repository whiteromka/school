<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Technology
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $active             Активность (1 = активна, 0 = нет)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Module[] $modules
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
