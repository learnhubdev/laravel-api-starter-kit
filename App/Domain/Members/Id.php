<?php

declare(strict_types=1);

namespace App\Domain\Members;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class Id
{
    private const VALUE_LENGTH = 18;

    /**
     * @var string
     */
    private readonly string $value;

    /**
     * @throws AssertionFailedException
     */
    private function __construct(string $value)
    {
        Assertion::string(value: $value, message: 'The id is required.');
        Assertion::length(value: $value, length: self::VALUE_LENGTH, message: sprintf('The length of the id must be %d', self::VALUE_LENGTH));

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param  string  $value
     * @return $this
     * @throws AssertionFailedException
     */
    public static function createFromString(string $value): self
    {
        return new self(value: $value);
    }
}
