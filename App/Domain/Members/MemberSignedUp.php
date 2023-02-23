<?php

declare(strict_types=1);

namespace App\Domain\Members;

final readonly class MemberSignedUp
{
    public function __construct(
        public Id $id,
        public FirstName $firstName,
        public LastName $lastName,
        public EmailAddress $emailAddress,
        public StatusName $status
    ) {
        //
    }
}
