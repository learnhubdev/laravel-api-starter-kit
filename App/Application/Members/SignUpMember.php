<?php

declare(strict_types=1);

namespace App\Application\Members;

final class SignUpMember
{
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $emailAddress,
        private readonly string $password
    ) {
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
    public function getPassword(): string
    {
        return $this->password;
    }
}
