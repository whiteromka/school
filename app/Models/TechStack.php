<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TechStack
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class TechStack extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    protected $table = 'tech_stacks';
}
