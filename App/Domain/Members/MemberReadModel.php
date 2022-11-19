<?php

declare(strict_types=1);

namespace App\Domain\Members;

use App\Infrastructure\Members\Member as MemberEloquentModel;
use Assert\AssertionFailedException;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Exception;

final class MemberReadModel
{
    public function __construct(
        private readonly Id $id,
        private readonly FirstName $firstName,
        private readonly LastName $lastName,
        private readonly EmailAddress $emailAddress,
        private readonly DateTimeImmutable $createdAt,
        private readonly DateTimeImmutable $updatedAt,
        private readonly ?DateTimeImmutable $emailVerifiedAt
    ) {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getEmailVerifiedAt(): ?DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @throws AssertionFailedException
     * @throws \Exception
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
            createdAt: new DateTimeImmutable(datetime: $member['createdAt']),
            updatedAt: new DateTimeImmutable(datetime: $member['updatedAt']),
            emailVerifiedAt: isset($member['emailVerifiedAt']) ? new DateTimeImmutable($member['emailVerifiedAt']) : null
        );
    }
}
