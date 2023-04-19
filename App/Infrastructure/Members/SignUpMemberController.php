<?php

declare(strict_types=1);

namespace App\Infrastructure\Members;

use App\Application\Members\SignUpMember;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Post;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final readonly class SignUpMemberController
{
    public function __construct(private readonly Dispatcher $commandBusDispatcher)
    {
    }

    #[Post(uri: 'member-sign-ups', name: 'api.v1.member-sign-ups')]
    public function __invoke(SignUpMemberFormRequest $signUpMemberFormRequest): Response
    {
        $this->commandBusDispatcher->dispatch(command: new SignUpMember(
            firstName: $signUpMemberFormRequest->input(key: 'first_name'),
            lastName: $signUpMemberFormRequest->input(key: 'last_name'),
            emailAddress: $signUpMemberFormRequest->input(key: 'email'),
            password: $signUpMemberFormRequest->input(key: 'password')
        ));

        return new Response(content: null, status: SymfonyResponse::HTTP_CREATED);
    }
}
