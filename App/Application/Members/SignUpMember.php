<?php

declare(strict_types=1);

namespace App\Application\Members;

final readonly class SignUpMember
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $emailAddress,
        public string $password
    ) {
    }
}
