<?php

declare(strict_types=1);

namespace App\Application\Members;

final class SignUpMember
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $emailAddress,
        public readonly string $password
    ) {
    }
}
