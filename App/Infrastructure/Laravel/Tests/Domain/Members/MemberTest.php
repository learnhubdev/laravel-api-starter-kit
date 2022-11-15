<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Tests\Domain\Members;

use App\Domain\Members\EmailAddress;
use App\Domain\Members\FirstName;
use App\Domain\Members\Id;
use App\Domain\Members\LastName;
use App\Domain\Members\Member;
use App\Domain\Members\MemberSignedUp;
use App\Domain\Members\Password;
use App\Infrastructure\Members\ArrayMemberRepository;
use Assert\AssertionFailedException;
use Faker\Factory;
use Illuminate\Hashing\BcryptHasher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Clock\MockClock;

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
            id: Id::createFromString(value: $this->memberRepository->generateIdentity()),
            firstName: FirstName::createFromString(value: $faker->firstName()),
            lastName: LastName::createFromString(value: $faker->lastName()),
            emailAddress: EmailAddress::createFromString(value: $faker->unique()->freeEmail()),
            createdAt: $this->clock->now(),
            updatedAt: $this->clock->now(),
            password: Password::createFromString(value: $this->hasher->make(value: $password))
        );

        $events = $member->releaseEvents();

        $this->assertCount(expectedCount: 1, haystack: $events);
        $this->assertInstanceOf(expected: MemberSignedUp::class, actual: $events[0]);
        $this->assertCount(expectedCount: 0, haystack: $member->releaseEvents());
        $this->assertInstanceOf(expected: Member::class, actual: $member);
    }
}
