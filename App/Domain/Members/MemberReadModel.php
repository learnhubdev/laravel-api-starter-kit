<?php

declare(strict_types=1);

namespace App\Domain\Members;

use App\Infrastructure\Members\Member as MemberEloquentModel;
use Assert\AssertionFailedException;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Exception;

final readonly class MemberReadModel
{
    public function __construct(
        public Id $id,
        public FirstName $firstName,
        public LastName $lastName,
        public EmailAddress $emailAddress,
        public StatusName $status,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
        public ?DateTimeImmutable $emailVerifiedAt
    ) {
    }

    /**
     * @throws AssertionFailedException
     * @throws Exception
     */
    public static function createFromEloquentModel(MemberEloquentModel $member): MemberReadModel
    {
        /** @var CarbonImmutable $createdAt */
        $createdAt = $member->created_at;
        /** @var CarbonImmutable $updatedAt */
        $updatedAt = $member->updated_at;
        /** @var CarbonImmutable|null $emailVerifiedAt */
        $emailVerifiedAt = $member->email_verified_at;

        return new self(
            id: Id::createFromString(value: $member->id),
            firstName: FirstName::createFromString(value: $member->first_name),
            lastName: LastName::createFromString(value: $member->last_name),
            emailAddress: EmailAddress::createFromString(value: $member->email),
            status: StatusName::PENDING,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
            emailVerifiedAt: $emailVerifiedAt ?? null
        );
    }

    /**
     * @throws AssertionFailedException
     * @throws Exception
     */
    public static function createFromArray(array $member): self
    {
        return new self(
            id: Id::createFromString(value: $member['id']),
            firstName: FirstName::createFromString(value: $member['firstName']),
            lastName: LastName::createFromString(value: $member['lastName']),
            emailAddress: EmailAddress::createFromString(value: $member['email']),
            status: StatusName::PENDING,
            createdAt: new DateTimeImmutable(datetime: $member['createdAt']),
            updatedAt: new DateTimeImmutable(datetime: $member['updatedAt']),
            emailVerifiedAt: isset($member['emailVerifiedAt']) ? new DateTimeImmutable($member['emailVerifiedAt']) : null
        );
    }
}
