<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Domain\Members\Member;
use App\Domain\Members\MemberReadModel;
use App\Domain\Members\MemberRepository;
use App\Domain\Members\MemberWasNotFound;
use Assert\AssertionFailedException;
use Godruoyi\Snowflake\Snowflake;

final class ArrayMemberRepository implements MemberRepository
{
    /**
     * @param  array<int, MemberReadModel>  $members
     */
    public function __construct(private array $members = [])
    {
    }

    public function generateIdentity(): string
    {
        return (new Snowflake())->id();
    }

    /**
     * @throws MemberWasNotFound
     * @throws AssertionFailedException
     */
    public function findByEmailAddress(string $emailAddress): MemberReadModel
    {
        foreach ($this->members as $member) {
            if ($member['email'] === $emailAddress) {
                return MemberReadModel::createFromArray([
                    'id' => $member['id'],
                    'firstName' => $member['first_name'],
                    'lastName' => $member['last_name'],
                    'email' => $member['email'],
                    'status' => $member['status'],
                    'createdAt' => $member['created_at'],
                    'updatedAt' => $member['updated_at'],
                ]);
            }
        }

        throw new MemberWasNotFound();
    }

    public function existsByEmailAddress(string $emailAddress): bool
    {
        foreach ($this->members as $member) {
            if ($member['email'] === $emailAddress) {
                return true;
            }
        }

        return false;
    }

    public function save(Member $member): void
    {
        $this->members[] = $member->mapForPersistence();
    }
}
