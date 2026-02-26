<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $telegram    // @rom_1989
 * @property string $telegram_id // 121324321
 * @property int $from_tgbot_unknown
 * @property string $username
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property null|int $password_verified
 * @property string|null $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property array $additional_data
 *
 * @property-read Collection|OauthAccount[] $oauthAccounts
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'telegram',
        'telegram_id',
        'password_verified',
        'from_tgbot_unknown',
        'username',
        'additional_data'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        //'additional_data'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'additional_data' => 'array',
        ];
    }

    protected $attributes = [
        'additional_data' => '{}',
    ];

    public function getFullNameOrEmail(): string
    {
        if ($this->name) {
            if ($this->last_name) {
                return $this->name . ' ' . $this->last_name;
            }
            return $this->name;
        }
        return $this->email;
    }

    /**
     * Связь с OauthAccounts
     */
    public function oauthAccounts(): hasMany
    {
        return $this->hasMany(OauthAccount::class, 'user_id', 'id');
    }
}
