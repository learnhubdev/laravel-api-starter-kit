<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Application\Members\SignUpMember;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Post;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

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
     * @return Response
     */
    #[Post(uri: 'member-sign-ups', name: 'api.v1.member-sign-ups')]
    public function __invoke(Request $request): Response
    {
        $this->commandBusDispatcher->dispatch(command: new SignUpMember(
            firstName: $request->input(key: 'first_name'),
            lastName: $request->input(key: 'last_name'),
            emailAddress: $request->input(key: 'email'),
            password: $request->input(key: 'password')
        ));

        return new Response(content: null, status: SymfonyResponse::HTTP_CREATED);
    }
}
