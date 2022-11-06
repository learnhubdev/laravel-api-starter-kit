<?php

declare(strict_types=1);

namespace App\Domain\Members;

use DateTimeImmutable;

final class Member
{
    /**
     * @param  string  $id
     * @param  string  $firstName
     * @param  string  $lastName
     * @param  EmailAddress  $emailAddress
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     * @param  string|null  $password
     * @param  DateTimeImmutable|null  $emailVerifiedAt
     * @param  array  $events
     */
    public function __construct(
        private readonly string $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly EmailAddress $emailAddress,
        private readonly DateTimeImmutable $createdAt,
        private readonly DateTimeImmutable $updatedAt,
        private readonly ?string $password,
        private ?DateTimeImmutable $emailVerifiedAt = null,
        private array $events = []
    ) {
        $this->events[] = new MemberSignedUp($this);
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
     * @return EmailAddress
     */
    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
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
     * @param  DateTimeImmutable  $date
     *
     * @return void
     */
    public function markAsVerified(DateTimeImmutable $date): void
    {
        $this->emailVerifiedAt = $date;

        $this->events[] = new MemberWasVerified($date);
    }

    /**
     * @return array
     */
    public function mapForPersistence(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmailAddress(),
            'password' => $this->getPassword(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'email_verified_at' => $this->getEmailVerifiedAt(),
        ];
    }

    /**
     * @return array<int, object>
     */
    public function releaseEvents(): array
    {
        return $this->events;
    }
}
