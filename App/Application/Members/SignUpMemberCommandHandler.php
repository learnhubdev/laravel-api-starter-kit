<?php

declare(strict_types=1);

namespace App\Application\Members;

use App\Application\Events\EventDispatcher;
use App\Domain\Members\EmailAddress;
use App\Domain\Members\EmailAddressIsAlreadyTaken;
use App\Domain\Members\Member;
use App\Domain\Members\MemberRepository;
use Assert\AssertionFailedException;
use Illuminate\Contracts\Hashing\Hasher;
use Symfony\Component\Clock\ClockInterface;

final class SignUpMemberCommandHandler
{
    /**
     * @param  MemberRepository  $memberRepository
     * @param  EventDispatcher  $eventDispatcher
     * @param  ClockInterface  $clock
     * @param  Hasher  $hasher
     */
    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly EventDispatcher $eventDispatcher,
        private readonly ClockInterface $clock,
        private readonly Hasher $hasher
    ) {
    }

    /**
     * @param  SignUpMember  $signUpMember
     * @return void
     *
     * @throws EmailAddressIsAlreadyTaken|AssertionFailedException
     */
    public function handle(SignUpMember $signUpMember): void
    {
        $emailAddress = EmailAddress::createFromString(emailAddress: $signUpMember->getEmailAddress());

        $emailAddressExists = $this->memberRepository->existsByEmailAddress(emailAddress: $emailAddress->getValue());

        if ($emailAddressExists) {
            throw new EmailAddressIsAlreadyTaken();
        }

        $member = new Member(
            id: $this->memberRepository->generateIdentity(),
            firstName: $signUpMember->getFirstName(),
            lastName: $signUpMember->getLastName(),
            emailAddress: $emailAddress,
            createdAt: $this->clock->now(),
            updatedAt: $this->clock->now(),
            password: $this->hasher->make(value: $signUpMember->getPassword())
        );

        $this->memberRepository->save(member: $member);

        $this->eventDispatcher->flushAll(events: $member->releaseEvents());
    }
}
