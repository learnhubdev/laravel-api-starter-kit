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
     * @return array<int, string>
     */
    public function mapForPersistence(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->emailAddress,
            'password' => $this->password,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'email_verified_at' => $this->emailVerifiedAt,
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
