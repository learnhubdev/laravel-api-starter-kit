<?php

declare(strict_types=1);

namespace App\Domain\Members;

enum StatusName: int
{
    case PENDING = 0;
    case ACTIVE = 1;
    case DEACTIVATED = 2;
    case DELETED = 3;

    private const TEXT_PENDING = 'Pending';

    private const TEXT_ACTIVE = 'Active';

    private const TEXT_DEACTIVATED = 'Deactivated';

    private const TEXT_DELETED = 'Deleted';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => self::TEXT_PENDING,
            self::ACTIVE => self::TEXT_ACTIVE,
            self::DEACTIVATED => self::TEXT_DEACTIVATED,
            self::DELETED => self::TEXT_DELETED,
        };
    }
}
