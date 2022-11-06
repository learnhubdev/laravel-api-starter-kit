<?php

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

    /**
     * @return string
     */
    public function generateIdentity(): string;

    /**
     * @param  string  $emailAddress
     * @return MemberReadModel
     */
    public function findByEmailAddress(string $emailAddress): MemberReadModel;

    /**
     * @param  string  $emailAddress
     * @return bool
     */
    public function existsByEmailAddress(string $emailAddress): bool;

    /**
     * @param  Member  $member
     * @return void
     */
    public function save(Member $member): void;
}
