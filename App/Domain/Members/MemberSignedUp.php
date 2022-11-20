<?php

declare(strict_types=1);

namespace App\Domain\Members;

final class MemberSignedUp
{
    public function __construct(
        public readonly Id $id,
        public readonly FirstName $firstName,
        public readonly LastName $lastName,
        public readonly EmailAddress $emailAddress,
        public readonly StatusName $status
    ) {
        //
    }
}
