<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Review
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $modules_id
 * @property int $stars
 * @property string $status
 * @property string $name
 * @property string $message
 *
 * @property-read User $user
 * @property-read Module|null $module
 */
class Review extends Model
{
    protected $fillable = [
        'user_id',
        'stars',
        'modules_id',
        'status',
        'message'
    ];

    protected $table = 'reviews';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'modules_id');
    }
}
