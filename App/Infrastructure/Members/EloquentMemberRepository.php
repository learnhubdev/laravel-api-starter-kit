<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Domain\Members\Member;
use App\Domain\Members\MemberReadModel;
use App\Domain\Members\MemberRepository;
use App\Infrastructure\Members\Member as MemberEloquentModel;
use Godruoyi\Snowflake\Snowflake;

final class EloquentMemberRepository implements MemberRepository
{
    private const DEFAULT_COLUMNS = [
        'id',
        'first_name',
        'last_name',
        'email',
        'created_at',
        'updated_at',
    ];

    /**
     * @param  MemberEloquentModel  $member
     */
    public function __construct(private readonly MemberEloquentModel $member)
    {
    }

    public function generateIdentity(): string
    {
        return (new Snowflake())->id();
    }

    /**
     * @param  string  $emailAddress
     * @param  array  $columns
     * @return MemberReadModel
     */
    public function findByEmailAddress(string $emailAddress, array $columns = self::DEFAULT_COLUMNS): MemberReadModel
    {
        $member = $this->member->newQuery()
            ->select(columns: $columns)
            ->where(column: 'email', operator: '=', value: $emailAddress)
            ->firstOrFail();

        return MemberReadModel::createFromEloquentModel($member);
    }

    /**
     * @param  string  $emailAddress
     * @return bool
     */
    public function existsByEmailAddress(string $emailAddress): bool
    {
        return $this->member->newQuery()
            ->where(column: 'email', operator: '=', value: $emailAddress)
            ->exists();
    }

    /**
     * @param  Member  $member
     * @return void
     */
    public function save(Member $member): void
    {
        $this->member->newQuery()->create(attributes: $member->mapForPersistence());
    }
}