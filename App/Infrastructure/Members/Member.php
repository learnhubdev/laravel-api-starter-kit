<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Snowflake\SnowflakeCast;

class Member extends Model
{
    use HasFactory;

    protected $table = 'users';

    public $timestamps = false;

    public $incrementing = false;

    protected $casts = [
        'id' => SnowflakeCast::class,
    ];
}
