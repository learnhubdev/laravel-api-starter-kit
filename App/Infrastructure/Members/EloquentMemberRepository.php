<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Domain\Members\Member;
use App\Domain\Members\MemberReadModel;
use App\Domain\Members\MemberRepository;
use App\Domain\Members\MemberWasNotFound;
use App\Infrastructure\Members\Member as MemberEloquentModel;
use Assert\AssertionFailedException;
use Godruoyi\Snowflake\Snowflake;

final class EloquentMemberRepository implements MemberRepository
{
    public function __construct(private readonly MemberEloquentModel $member)
    {
    }

    public function generateIdentity(): string
    {
        return (new Snowflake())->id();
    }

    /**
     * @throws MemberWasNotFound|AssertionFailedException
     */
    public function findByEmailAddress(string $emailAddress, array $columns = self::DEFAULT_COLUMNS): MemberReadModel
    {
        $member = $this->member->newQuery()
            ->select(columns: $columns)
            ->where(column: 'email', operator: '=', value: $emailAddress)
            ->first();

        if (! $member) {
            throw new MemberWasNotFound();
        }

        return MemberReadModel::createFromEloquentModel(member: $member);
    }

    public function existsByEmailAddress(string $emailAddress): bool
    {
        return $this->member->newQuery()
            ->where(column: 'email', operator: '=', value: $emailAddress)
            ->exists();
    }

    public function save(Member $member): void
    {
        $this->member->newQuery()->create(attributes: $member->mapForPersistence());
    }
}
