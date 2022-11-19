<?php

declare(strict_types=1);

namespace App\Application\Members;

use App\Application\Events\EventDispatcher;
use App\Domain\Members\EmailAddress;
use App\Domain\Members\EmailAddressIsAlreadyTaken;
use App\Domain\Members\FirstName;
use App\Domain\Members\Id;
use App\Domain\Members\LastName;
use App\Domain\Members\Member;
use App\Domain\Members\MemberRepository;
use App\Domain\Members\Password;
use Assert\AssertionFailedException;
use Illuminate\Contracts\Hashing\Hasher;
use Symfony\Component\Clock\ClockInterface;

final class SignUpMemberCommandHandler
{
    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly EventDispatcher $eventDispatcher,
        private readonly ClockInterface $clock,
        private readonly Hasher $hasher
    ) {
    }

    /**
     * @throws EmailAddressIsAlreadyTaken|AssertionFailedException
     */
    public function handle(SignUpMember $signUpMember): void
    {
        $emailAddress = EmailAddress::createFromString(value: $signUpMember->getEmailAddress());

        $emailAddressExists = $this->memberRepository->existsByEmailAddress(emailAddress: $emailAddress->getValue());

        if ($emailAddressExists) {
            throw new EmailAddressIsAlreadyTaken();
        }

        $member = Member::signUp(
            id: Id::createFromString(value: $this->memberRepository->generateIdentity()),
            firstName: FirstName::createFromString(value: $signUpMember->getFirstName()),
            lastName: LastName::createFromString(value: $signUpMember->getLastName()),
            emailAddress: $emailAddress,
            createdAt: $this->clock->now(),
            updatedAt: $this->clock->now(),
            password: Password::createFromString(value: $this->hasher->make(value: $signUpMember->getPassword()))
        );

        $this->memberRepository->save(member: $member);

        $this->eventDispatcher->dispatchMultiple(events: $member->releaseEvents());
    }
}
