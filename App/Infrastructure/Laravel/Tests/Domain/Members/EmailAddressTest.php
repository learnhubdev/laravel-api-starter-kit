<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Tests\Domain\Members;

use App\Domain\Members\EmailAddress;
use Assert\AssertionFailedException;
use Faker\Factory;
use Tests\TestCase;

final class EmailAddressTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     *
     * @throws AssertionFailedException
     */
    public function it_creates_a_valid_email_address(): void
    {
        $faker = Factory::create();

        $emailAddress = EmailAddress::createFromString(value: $faker->unique()->freeEmail());

        $this->assertNotNull($emailAddress);
        $this->assertInstanceOf(expected: EmailAddress::class, actual: $emailAddress);
    }

    /**
     * @test
     *
     * @param  string  $emailAddress
     * @param  string  $message
     * @return void
     *
     * @throws AssertionFailedException
     * @dataProvider emailAddressesDataProvider
     */
    public function email_address_validation_checks(string $emailAddress, string $message): void
    {
        $this->expectException(exception: AssertionFailedException::class);
        $this->expectExceptionMessage(message: $message);

        EmailAddress::createFromString(value: $emailAddress);
    }

    /**
     * @return string[][]
     */
    public function emailAddressesDataProvider(): array
    {
        return [
            'invalid email address format #1' => [
                'invalidaddress',
                'The email address must be in a valid format.',
            ],
            'invalid email address format #2' => [
                'invalidaddress@test',
                'The email address must be in a valid format.',
            ],
            'invalid email address format #3' => [
                'invalidaddress@test.',
                'The email address must be in a valid format.',
            ],
            'invalid email address format #4' => [
                'invalidaddress.com',
                'The email address must be in a valid format.',
            ],
            '200 maximum characters for email address' => [
                str_repeat(string: 'a', times: 300),
                'The email address must be in a valid format.',
            ],
        ];
    }
}
