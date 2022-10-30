<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Infrastructure\Laravel\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Snowflake\SnowflakeCast;

/**
 * App\Infrastructure\Members\Member
 *
 * @property mixed|null $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static Builder|Member newModelQuery()
 * @method static Builder|Member newQuery()
 * @method static Builder|Member query()
 * @method static Builder|Member whereCreatedAt($value)
 * @method static Builder|Member whereEmail($value)
 * @method static Builder|Member whereEmailVerifiedAt($value)
 * @method static Builder|Member whereFirstName($value)
 * @method static Builder|Member whereId($value)
 * @method static Builder|Member whereLastName($value)
 * @method static Builder|Member wherePassword($value)
 * @method static Builder|Member whereRememberToken($value)
 * @method static Builder|Member whereUpdatedAt($value)
 * @mixin Eloquent
 */
final class Member extends BaseModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => SnowflakeCast::class,
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
        'created_at' => 'datetime_immutable',
        'updated_at' => 'datetime_immutable',
        'email_verified_at' => 'datetime_immutable',
    ];
}
