<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Tests\Domain\Members;

use App\Domain\Members\EmailAddress;
use App\Domain\Members\Member;
use App\Domain\Members\MemberSignedUp;
use App\Infrastructure\Members\ArrayMemberRepository;
use Assert\AssertionFailedException;
use Faker\Factory;
use Illuminate\Hashing\BcryptHasher;
use Symfony\Component\Clock\MockClock;
use Tests\TestCase;

final class MemberTest extends TestCase
{
    protected function setUp(): void
    {
        $this->memberRepository = new ArrayMemberRepository();
        $this->clock = new MockClock();
        $this->hasher = new BcryptHasher();
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws AssertionFailedException
     */
    public function it_raises_an_event_called_member_signed_up_when_the_method_sign_up_is_called(): void
    {
        $faker = Factory::create();

        $password = $faker->password();

        $member = Member::signUp(
            id: $this->memberRepository->generateIdentity(),
            firstName: $faker->firstName(),
            lastName: $faker->lastName(),
            emailAddress: EmailAddress::createFromString(emailAddress: $faker->unique()->freeEmail()),
            createdAt: $this->clock->now(),
            updatedAt: $this->clock->now(),
            password: $this->hasher->make(value: $password)
        );

        $events = $member->releaseEvents();

        $this->assertCount(expectedCount: 1, haystack: $events);
        $this->assertInstanceOf(expected: MemberSignedUp::class, actual: $events[0]);
        $this->assertCount(expectedCount: 0, haystack: $member->releaseEvents());
        $this->assertInstanceOf(expected: Member::class, actual: $member);
        $this->assertTrue(condition: $this->hasher->check(value: $password, hashedValue: $member->getPasswordFromTests()));
    }
}
