<?php

namespace Tests\Application\Members;

use App\Application\Events\EventDispatcher;
use App\Application\Members\SignUpMember;
use App\Domain\Members\MemberRepository;
use App\Infrastructure\Members\ArrayMemberRepository;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Faker\Factory;
use Illuminate\Contracts\Bus\Dispatcher;
use Laravel\Events\FakeEventDispatcher;
use Laravel\Foundation\Application;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Clock\MockClock;
use Tests\CreatesApplication;

/**
 * Defines application features from the specific context.
 */
class SignUpMemberCommandHandler implements Context
{
    use CreatesApplication;

    private Application $application;

    private SignUpMember $signUpMember;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->application = $this->createApplication();
        $this->application->singleton(abstract:  MemberRepository::class, concrete: ArrayMemberRepository::class);
        $this->application->singleton(abstract:  EventDispatcher::class, concrete: FakeEventDispatcher::class);
        $this->application->singleton(abstract:  ClockInterface::class, concrete: MockClock::class);
    }

    /**
     * @When  /^the visitor provides personal details$/
     */
    public function theVisitorProvidesPersonalDetails(): void
    {
        $faker = Factory::create();

        $this->signUpMember = new SignUpMember(
            firstName: $faker->firstName(),
            lastName: $faker->lastName(),
            emailAddress:  $faker->unique()->freeEmail(),
            password: 'Secret123'
        );
    }

    /**
     * @Then /^the visitor signs up$/
     */
    public function theVisitorSignsUp(): void
    {
        $this->application->make(abstract: Dispatcher::class)->dispatchNow(command: $this->signUpMember);
    }

    /**
     * @Given /^a member already exists in the platform$/
     */
    public function aMemberAlreadyExistsInThePlatform()
    {
        throw new PendingException();
    }

    /**
     * @When /^the visitor provides personal details including an existing member email address$/
     */
    public function theVisitorProvidesPersonalDetailsIncludingAnExistingMemberEmailAddress()
    {
        throw new PendingException();
    }

    /**
     * @Then /^the visitor is not able to join the platform$/
     */
    public function theVisitorIsNotAbleToJoinThePlatform()
    {
        throw new PendingException();
    }
}
