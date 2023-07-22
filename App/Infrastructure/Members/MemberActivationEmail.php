<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Domain\Members\FirstName;
use App\Domain\Members\LastName;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MemberActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private readonly FirstName $firstName,
        private readonly LastName $lastName,
        private readonly Repository $configurationRepository
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Activate your membership',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'Infrastructure.Members.activation',
            with: [
                'fullName' => $this->firstName->getValue().' '.$this->lastName->getValue(),
                'activationUrl' => $this->configurationRepository->get(key: 'members.activationUrl'),
                'appName' => $this->configurationRepository->get(key: 'app.name'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
