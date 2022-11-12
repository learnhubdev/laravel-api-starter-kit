<?php

declare(strict_types=1);

namespace App\Domain\Members;

use DateTimeImmutable;

final class Member
{
    private DateTimeImmutable $emailVerifiedAt;

    public array $events = [];

    /**
     * @param  string  $id
     * @param  string  $firstName
     * @param  string  $lastName
     * @param  EmailAddress  $emailAddress
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     * @param  string|null  $password
     */
    private function __construct(
        private readonly string $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly EmailAddress $emailAddress,
        private readonly DateTimeImmutable $createdAt,
        private readonly DateTimeImmutable $updatedAt,
        private readonly ?string $password
    ) {
    }

    /**
     * @param  string  $id
     * @param  string  $firstName
     * @param  string  $lastName
     * @param  EmailAddress  $emailAddress
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     * @param  string|null  $password
     * @return self
     */
    public static function signUp(
        string $id,
        string $firstName,
        string $lastName,
        EmailAddress $emailAddress,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?string $password
    ): self {
        $member = new self(
            id: $id,
            firstName: $firstName,
            lastName: $lastName,
            emailAddress: $emailAddress,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
            password: $password
        );

        $member->raiseEvent(new MemberSignedUp(member: $member));

        return $member;
    }

    /**
     * @param  DateTimeImmutable  $date
     * @return void
     */
    public function markAsVerified(DateTimeImmutable $date): void
    {
        $this->emailVerifiedAt = $date;

        $this->raiseEvent(new MemberWasVerified(date: $date));
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
     * @param  object  $event
     * @return void
     */
    public function raiseEvent(object $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return array<int, object>
     */
    public function releaseEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }
}
