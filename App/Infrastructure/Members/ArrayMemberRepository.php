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
     *
     * @throws CouldNotFindMember
     */
    public function findByEmailAddress(string $emailAddress): MemberReadModel
    {
        foreach ($this->members as $member) {
            if ($member->getEmailAddressFromTests()->getValue() === $emailAddress) {
                return MemberReadModel::createFromArray([
                    'id' => $member->getIdFromTests(),
                    'firstName' => $member->getFirstNameFromTests(),
                    'lastName' => $member->getLastNameFromTests(),
                    'email' => $member->getEmailAddressFromTests()->getValue(),
                    'createdAt' => $member->getCreatedAtFromTests()->format(format: 'Y-m-d H:i:s'),
                    'updatedAt' => $member->getUpdatedAtFromTests()->format(format: 'Y-m-d H:i:s'),
                ]);
            }
        }

        throw new CouldNotFindMember();
    }

    /**
     * @param  string  $emailAddress
     * @return bool
     */
    public function existsByEmailAddress(string $emailAddress): bool
    {
        foreach ($this->members as $member) {
            if ($member->getEmailAddressFromTests()->getValue() === $emailAddress) {
                return true;
            }
        }

        return false;
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
