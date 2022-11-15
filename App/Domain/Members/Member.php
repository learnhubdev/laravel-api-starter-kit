<?php

declare(strict_types=1);

namespace App\Domain\Members;

use DateTimeImmutable;

final class Member
{
    private ?DateTimeImmutable $emailVerifiedAt = null;

    public array $events = [];

    /**
     * @param  Id  $id
     * @param  FirstName  $firstName
     * @param  LastName  $lastName
     * @param  EmailAddress  $emailAddress
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     * @param  Password|null  $password
     */
    private function __construct(
        private readonly Id $id,
        private readonly FirstName $firstName,
        private readonly LastName $lastName,
        private readonly EmailAddress $emailAddress,
        private readonly DateTimeImmutable $createdAt,
        private readonly DateTimeImmutable $updatedAt,
        private readonly ?Password $password
    ) {
    }

    /**
     * @param  Id  $id
     * @param  FirstName  $firstName
     * @param  LastName  $lastName
     * @param  EmailAddress  $emailAddress
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     * @param  Password|null  $password
     * @return self
     */
    public static function signUp(
        Id $id,
        FirstName $firstName,
        LastName $lastName,
        EmailAddress $emailAddress,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?Password $password
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
            'id' => $this->id->getValue(),
            'first_name' => $this->firstName->getValue(),
            'last_name' => $this->lastName->getValue(),
            'email' => $this->emailAddress->getValue(),
            'password' => $this->password->getValue(),
            'created_at' => $this->createdAt->format(format: 'Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format(format: 'Y-m-d H:i:s'),
            'email_verified_at' => $this->emailVerifiedAt?->format(format: 'Y-m-d H:i:s'),
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
