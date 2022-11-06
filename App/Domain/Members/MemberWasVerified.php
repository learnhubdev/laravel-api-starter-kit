<?php

declare(strict_types=1);

namespace App\Domain\Members;

final class MemberWasVerified
{
    /**
     * @param  \DateTimeImmutable  $date
     */
    public function __construct(public readonly \DateTimeImmutable $date)
    {
        //
    }
}