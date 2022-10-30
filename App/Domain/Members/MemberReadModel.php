<?php

declare(strict_types=1);

namespace App\Domain\Members;

use App\Infrastructure\Members\Member as MemberEloquentModel;

final class MemberReadModel
{
    /**
     * @param  string  $id
     * @param  string  $firstName
     * @param  string  $lastName
     * @param  string  $emailAddress
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string|null  $emailVerifiedAt
     */
    public function __construct(
        private readonly string $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $emailAddress,
        private readonly string $createdAt,
        private readonly string $updatedAt,
        private readonly ?string $emailVerifiedAt
    ) {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getEmailVerifiedAt(): ?string
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @param  MemberEloquentModel  $member
     * @return MemberReadModel
     */
    public static function createFromEloquentModel(MemberEloquentModel $member): MemberReadModel
    {
        return new self(
            id: $member->id,
            firstName: $member->first_name,
            lastName: $member->last_name,
            emailAddress: $member->email,
            createdAt: $member->created_at,
            updatedAt: $member->updated_at,
            emailVerifiedAt: $member->email_verified_at
        );
    }
}
