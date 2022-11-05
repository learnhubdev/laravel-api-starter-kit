<?php

declare(strict_types=1);

namespace App\Application\Members;

use App\Domain\Members\EmailAddress;
use App\Domain\Members\EmailAddressIsAlreadyTaken;
use App\Domain\Members\Member;
use App\Domain\Members\MemberRepository;
use App\Domain\Members\MemberSignedUp;
use Assert\AssertionFailedException;
use DateTimeImmutable;
use Illuminate\Contracts\Events\Dispatcher;
use Symfony\Component\Clock\ClockInterface;

final class SignUpMemberCommandHandler
{
    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly Dispatcher $eventDispatcher,
        private readonly ClockInterface $clock
    ) {
    }

    /**
     * @param  SignUpMemberCommand  $signUpMemberCommand
     * @return void
     *
     * @throws EmailAddressIsAlreadyTaken|AssertionFailedException
     */
    public function handle(SignUpMemberCommand $signUpMemberCommand): void
    {
        $emailAddress = new EmailAddress($signUpMemberCommand->getEmailAddress());

        $emailAddressExists = $this->memberRepository->existsByEmailAddress(emailAddress: $emailAddress->getValue());

        if ($emailAddressExists) {
            throw new EmailAddressIsAlreadyTaken();
        }

        $member = new Member(
            id: $this->memberRepository->generateIdentity(),
            firstName: $signUpMemberCommand->getFirstName(),
            lastName: $signUpMemberCommand->getLastName(),
            emailAddress: $emailAddress,
            createdAt: $this->clock->now(),
            updatedAt: $this->clock->now(),
            password: $signUpMemberCommand->getPassword(),
        );

        $this->eventDispatcher->push(event: MemberSignedUp::class, payload: ['member' => $member]);

        $this->memberRepository->save(member: $member);

        $this->eventDispatcher->flush(event: MemberSignedUp::class);
    }
}
