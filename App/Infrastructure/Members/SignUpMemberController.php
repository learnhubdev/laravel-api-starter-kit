<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Application\Members\SignUpMember;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Post;

final class SignUpMemberController
{
    /**
     * @param  Dispatcher  $commandBusDispatcher
     */
    public function __construct(private readonly Dispatcher $commandBusDispatcher)
    {
    }

    /**
     * @param  Request  $request
     */
    #[Post(uri: 'member-sign-ups', name: 'api.v1.member-sign-ups', middleware: ['guest'])]
    public function __invoke(Request $request): void
    {
        $this->commandBusDispatcher->dispatch(command: SignUpMember::class);
    }
}
