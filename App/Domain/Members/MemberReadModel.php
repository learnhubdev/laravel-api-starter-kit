<?php

declare(strict_types=1);

namespace App\Domain\Members;

use App\Infrastructure\Members\Member as MemberEloquentModel;
use Assert\AssertionFailedException;
use Carbon\CarbonImmutable;
use DateTimeImmutable;

final class MemberReadModel
{
    /**
     * @param  Id  $id
     * @param  FirstName  $firstName
     * @param  LastName  $lastName
     * @param  EmailAddress  $emailAddress
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     * @param  DateTimeImmutable|null  $emailVerifiedAt
     */
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

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return FirstName
     */
    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    /**
     * @return LastName
     */
    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    /**
     * @return EmailAddress
     */
    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getEmailVerifiedAt(): ?DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @param  MemberEloquentModel  $member
     * @return MemberReadModel
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
     * @param  array  $member
     * @return self
     * @throws AssertionFailedException
     * @throws \Exception
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
