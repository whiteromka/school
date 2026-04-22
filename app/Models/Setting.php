<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Модель для работы с таблицей настроек (settings).
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $value
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Setting extends Model
{
    use HasFactory;

    public const TYPE_INT = 'integer';
    public const TYPE_STRING = 'string';
    public const TYPE_JSON = 'json';
    public const TYPE_ARRAY = 'array';

    public static function getTypes(): array
    {
        return [
            self::TYPE_INT => self::TYPE_INT,
            self::TYPE_STRING => self::TYPE_STRING,
            self::TYPE_JSON => self::TYPE_JSON,
            self::TYPE_ARRAY => self::TYPE_ARRAY,
        ];
    }

    /**
     * Имя таблицы в базе данных.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * Атрибуты, которые можно массово назначать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'value',
        'description'
    ];

    /**
     * Атрибуты, которые должны быть скрыты при сериализации.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Атрибуты, которые должны быть приведены к определённым типам.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Получить значение настройки по имени.
     *
     * @param string $name Название настройки
     * @param mixed $default Значение по умолчанию, если настройка не найдена
     * @return mixed
     */
    public static function getValue(string $name, mixed $default = null): mixed
    {
        $setting = self::where('name', $name)->first();

        if (!$setting) {
            return $default;
        }

        return match ($setting->type) {
            self::TYPE_INT => (int) $setting->value,
            self::TYPE_JSON => json_decode($setting->value, true),
            self::TYPE_ARRAY => json_decode($setting->value, true) ?? [],
            default => (string) $setting->value,
        };
    }

    /**
     * Установить значение настройки.
     *
     * @param string $name Название настройки
     * @param mixed $value Значение настройки
     * @param string $type Тип значения (string, int, bool, json, array, float)
     * @return self
     */
    public static function setValue(string $name, mixed $value, string $type = 'string'): self
    {
        $storedValue = match ($type) {
            self::TYPE_JSON, self::TYPE_ARRAY => json_encode($value),
            self::TYPE_INT => (int) $value,
            default => (string) $value,
        };

        return self::updateOrCreate(
            ['name' => $name],
            [
                'value' => $storedValue,
                'type' => $type,
            ]
        );
    }
}
