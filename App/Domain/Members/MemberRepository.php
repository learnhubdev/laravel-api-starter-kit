<?php

declare(strict_types=1);

namespace App\Domain\Members;

interface MemberRepository
{
    public const DEFAULT_COLUMNS = [
        'id',
        'first_name',
        'last_name',
        'email',
        'created_at',
        'updated_at',
    ];

    public function generateIdentity(): string;

    public function findByEmailAddress(string $emailAddress): MemberReadModel;

    public function existsByEmailAddress(string $emailAddress): bool;

    public function save(Member $member): void;
}
