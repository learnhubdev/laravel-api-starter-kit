<?php

declare(strict_types=1);

namespace App\Application\Members;

use App\Domain\Members\MemberSignedUp;
use App\Infrastructure\Members\MemberActivationEmail;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class SendMemberActivationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private readonly Mailer $mailer,
        private readonly Repository $configurationRepository
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(MemberSignedUp $event): void
    {
        $this->mailer->to(users: [$event->emailAddress->getValue()])
            ->send(
                mailable: new MemberActivationEmail(
                    firstName: $event->firstName,
                    lastName: $event->lastName,
                    configurationRepository: $this->configurationRepository
                )
            );
    }
}
