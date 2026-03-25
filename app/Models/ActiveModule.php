<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Class ActiveModule
 *
 * @property int $id
 * @property int $module_id
 * @property string $name
 * @property Carbon|null $started_at
 * @property Carbon|null $ended_at
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Module|null $module
 * @property-read Collection|User[] $users
 */
class ActiveModule extends Model
{
    const STATUS_OPEN = 'open';
    const STATUS_STARTED_FREE = 'started_free';
    const STATUS_STARTED_FULL = 'started_full';
    const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'module_id',
        'started_at',
        'ended_at',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            /** Статусы, которые должны быть уникальны в пределах одного module_id */
            $uniqueStatuses = [
                self::STATUS_OPEN,
                self::STATUS_STARTED_FREE,
                self::STATUS_STARTED_FULL,
            ];
            if (in_array($model->status, $uniqueStatuses)) {
                $exists = static::query()
                    ->where('module_id', $model->module_id)
                    ->where('status', $model->status)
                    ->when($model->id, fn($q) => $q->where('id', '!=', $model->id))
                    ->exists();

                if ($exists) {
                    throw new Exception("Запись со статусом '{$model->status}' уже существует для модуля #{$model->module_id}");
                }
            }
        });
    }

    /**
     * Связь с модулем
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Связь с пользователями (many-to-many)
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'active_module_to_user')
            ->withPivot('joined_at')
            ->withTimestamps();
    }

    public function getRuStatus(): string
    {
        $map = self::statusMap();
        return isset($map[$this->status]) ? $map[$this->status] : '';
    }

    public static function statusMap(): array
    {
        return [
            self::STATUS_OPEN => 'Запись открыта',
            self::STATUS_STARTED_FREE => 'Идут бесплатные уроки',
            self::STATUS_STARTED_FULL => 'Запись закрыта',
            self::STATUS_FINISHED => 'Завершен'
        ];
    }
}
