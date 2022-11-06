<?php

namespace App\Domain\Members;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class CouldNotFindMember extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'The member was not found.',
            code: Response::HTTP_NOT_FOUND
        );
    }
}
