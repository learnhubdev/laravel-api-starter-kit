<?php

declare(strict_types=1);

namespace App\Domain\Members;

final class MemberSignedUp
{
    public function __construct(public readonly Member $member)
    {
        //
    }
}
