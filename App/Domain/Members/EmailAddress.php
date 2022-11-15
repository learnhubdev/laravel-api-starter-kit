<?php

declare(strict_types=1);

namespace App\Domain\Members;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class EmailAddress
{
    private const VALUE_MAX_LENGTH = 200;

    /**
     * @var string
     */
    private readonly string $value;

    /**
     * @param  string  $value
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $value)
    {
        Assertion::string(value: $value, message: 'The email address is required.');
        Assertion::email(value: $value, message: 'The email address must be in a valid format.');
        Assertion::maxLength(value: $value, maxLength: self::VALUE_MAX_LENGTH, message: sprintf('The maximum length of the email address must be %d', self::VALUE_MAX_LENGTH));

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
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function createFromString(string $value): self
    {
        return new self(value: $value);
    }
}
