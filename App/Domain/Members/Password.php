<?php

declare(strict_types=1);

namespace App\Domain\Members;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class Password
{
    private const VALUE_MIN_LENGTH = 8;

    private readonly string $value;

    /**
     * @throws AssertionFailedException
     */
    private function __construct(string $value)
    {
        Assertion::string(value: $value, message: 'The password is required.');
        Assertion::minLength(value: $value, minLength: self::VALUE_MIN_LENGTH, message: sprintf('The maximum length of the password must be %d', self::VALUE_MIN_LENGTH));

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
