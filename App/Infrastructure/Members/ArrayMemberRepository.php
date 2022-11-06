<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Domain\Members\CouldNotFindMember;
use App\Domain\Members\Member;
use App\Domain\Members\MemberReadModel;
use App\Domain\Members\MemberRepository;
use Godruoyi\Snowflake\Snowflake;

final class ArrayMemberRepository implements MemberRepository
{
    /**
     * @param  array<int, Member>  $members
     */
    public function __construct(private array $members = [])
    {

    }

    public function generateIdentity(): string
    {
        return (new Snowflake())->id();
    }

    /**
     * @param  string  $emailAddress
     * @return MemberReadModel
     * @throws CouldNotFindMember
     */
    public function findByEmailAddress(string $emailAddress): MemberReadModel
    {
        $member = $this->members[$emailAddress] ?? throw new CouldNotFindMember();

        return MemberReadModel::createFromArray([
            'id' => $member['id'],
            'firstName' => $member['first_name'],
            'lastName' => $member['last_name'],
            'emailAddress' => $member['email'],
            'createdAt' => $member['created_at'],
            'updatedAt' => $member['updated_at'],
            'emailVerifiedAt' => $member['email_verified_at'] ?? null
        ]);
    }

    /**
     * @param  string  $emailAddress
     * @return bool
     */
    public function existsByEmailAddress(string $emailAddress): bool
    {
        return isset($this->members[$emailAddress]);
    }

    /**
     * @param  Member  $member
     * @return void
     */
    public function save(Member $member): void
    {
        $this->members[] = $member;
    }
}
