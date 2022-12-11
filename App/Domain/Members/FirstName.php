<?php

declare(strict_types=1);

namespace App\Domain\Members;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class FirstName
{
    private const VALUE_MAX_LENGTH = 100;

    private readonly string $value;

    /**
     * @throws AssertionFailedException
     */
    private function __construct(string $value)
    {
        Assertion::string(value: $value, message: 'The first name is required.');
        Assertion::maxLength(value: $value, maxLength: self::VALUE_MAX_LENGTH, message: sprintf('The maximum length of the first name must be %d', self::VALUE_MAX_LENGTH));

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function createFromString(string $value): self
    {
        return new self(value: $value);
    }
}
