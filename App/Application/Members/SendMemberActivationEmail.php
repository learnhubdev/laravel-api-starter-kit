<?php

declare(strict_types=1);

namespace App\Application\Members;

use App\Domain\Members\MemberSignedUp;
use App\Infrastructure\Members\MemberActivationEmail;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;

final readonly class SendMemberActivationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private Mailer $mailer,
        private Repository $configurationRepository
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(MemberSignedUp $event): bool
    {
        return (bool) $this->mailer->to(users: [$event->emailAddress->getValue()])
            ->send(
                mailable: new MemberActivationEmail(
                    firstName: $event->firstName,
                    lastName: $event->lastName,
                    configurationRepository: $this->configurationRepository
                )
            );
    }
}
