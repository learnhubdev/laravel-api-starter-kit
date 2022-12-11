<?php

declare(strict_types=1);

namespace App\Domain\Members;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class EmailAddressIsAlreadyTaken extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'The email address is already taken.',
            code: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
