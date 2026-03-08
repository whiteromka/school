<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $gender
 * @property Carbon|null $birthday
 * @property string|null $country
 * @property string|null $city
 * @property string|null $industry
 * @property string|null $job
 * @property bool $is_free_offer
 * @property bool $is_money_offer
 * @property int|null $level
 * @property string|null $obout
 * @property int|null $years_experience
 * @property string|null $github
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'gender',
        'birthday',
        'country',
        'city',
        'industry',
        'job',
        'is_free_offer',
        'is_money_offer',
        'level',
        'obout',
        'years_experience',
        'github',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'is_free_offer' => 'boolean',
            'is_money_offer' => 'boolean',
            'level' => 'integer',
            'years_experience' => 'integer',
        ];
    }

    /**
     * Связь с пользователем
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
