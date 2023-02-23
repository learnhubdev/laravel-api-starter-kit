<?php

declare(strict_types=1);

namespace App\Domain\Members;

final readonly class MemberWasVerified
{
    public function __construct(public \DateTimeImmutable $date)
    {
        //
    }
}
