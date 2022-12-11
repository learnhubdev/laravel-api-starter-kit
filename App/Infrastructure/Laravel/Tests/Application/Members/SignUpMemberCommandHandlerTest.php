<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Tests\Application\Members;

use App\Application\Members\SignUpMember;
use App\Application\Members\SignUpMemberCommandHandler;
use App\Domain\Members\EmailAddressIsAlreadyTaken;
use App\Domain\Members\MemberSignedUp;
use App\Domain\Members\MemberWasNotFound;
use App\Infrastructure\Members\ArrayMemberRepository;
use Assert\AssertionFailedException;
use Faker\Factory;
use Illuminate\Hashing\BcryptHasher;
use Laravel\Events\Dispatcher;
use Laravel\Events\FakeEventDispatcher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Clock\MockClock;

final class SignUpMemberCommandHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->memberRepository = new ArrayMemberRepository();
        $this->eventDispatcher = new FakeEventDispatcher(dispatcher: new Dispatcher());
        $this->clock = new MockClock();
        $this->hasher = new BcryptHasher();
    }

    /**
     * @test
     *
     * @throws EmailAddressIsAlreadyTaken
     * @throws AssertionFailedException
     * @throws MemberWasNotFound
     */
    public function a_new_member_can_sign_up(): void
    {
        $faker = Factory::create();

        $signUpMemberCommandHandler = new SignUpMemberCommandHandler(
            memberRepository: $this->memberRepository,
            eventDispatcher:  $this->eventDispatcher,
            clock: $this->clock,
            hasher: $this->hasher
        );

        $emailAddress = $faker->unique()->freeEmail();

        $signUpMemberCommandHandler->handle(
            new SignUpMember(
                firstName: $faker->firstName(),
                lastName: $faker->lastName(),
                emailAddress:  $emailAddress,
                password: $faker->password()
            )
        );

        $this->eventDispatcher->assertDispatched(event: MemberSignedUp::class);

        $this->assertNotNull(actual: $this->memberRepository->findByEmailAddress($emailAddress));
        $this->assertTrue(condition: $this->memberRepository->existsByEmailAddress($emailAddress));
    }

    /**
     * @test
     *
     * @throws EmailAddressIsAlreadyTaken
     * @throws AssertionFailedException
     */
    public function a_new_member_cannot_sign_up_with_an_existing_email_address(): void
    {
        $this->expectException(exception: EmailAddressIsAlreadyTaken::class);

        $faker = Factory::create();

        $signUpMemberCommandHandler = new SignUpMemberCommandHandler(
            memberRepository: $this->memberRepository,
            eventDispatcher:  $this->eventDispatcher,
            clock: $this->clock,
            hasher: $this->hasher
        );

        $emailAddress = 'myemailaddress@gmail.com';

        $signUpMemberCommandHandler->handle(
            new SignUpMember(
                firstName: $faker->firstName(),
                lastName: $faker->lastName(),
                emailAddress:  $emailAddress,
                password: $faker->password()
            )
        );

        $signUpMemberCommandHandler->handle(
            new SignUpMember(
                firstName: $faker->firstName(),
                lastName: $faker->lastName(),
                emailAddress:  $emailAddress,
                password: $faker->password()
            )
        );

        $this->eventDispatcher->assertDispatchedTimes(event: MemberSignedUp::class, times: 1);
    }
}
