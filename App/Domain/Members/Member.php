<?php

declare(strict_types=1);

namespace App\Domain\Members;

use DateTimeImmutable;

final class Member
{
    private ?DateTimeImmutable $emailVerifiedAt = null;

    public array $events = [];

    private function __construct(
        private readonly Id $id,
        private readonly FirstName $firstName,
        private readonly LastName $lastName,
        private readonly EmailAddress $emailAddress,
        private readonly StatusName $status,
        private readonly DateTimeImmutable $createdAt,
        private readonly DateTimeImmutable $updatedAt,
        private readonly ?Password $password
    ) {
    }

    public static function signUp(
        Id $id,
        FirstName $firstName,
        LastName $lastName,
        EmailAddress $emailAddress,
        StatusName $status,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?Password $password
    ): self {
        $member = new self(
            id: $id,
            firstName: $firstName,
            lastName: $lastName,
            emailAddress: $emailAddress,
            status: $status,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
            password: $password
        );

        $member->raiseEvent(
            new MemberSignedUp(
                id: $id,
                firstName: $firstName,
                lastName: $lastName,
                emailAddress: $emailAddress,
                status: $status
            )
        );

        return $member;
    }

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
            'status' => $this->status->value,
            'password' => $this->password->getValue(),
            'created_at' => $this->createdAt->format(format: 'Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format(format: 'Y-m-d H:i:s'),
            'email_verified_at' => $this->emailVerifiedAt?->format(format: 'Y-m-d H:i:s'),
        ];
    }

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
