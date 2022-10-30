<?php

namespace App\Infrastructure\Members;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Post;

class SignUpMemberController
{
    /**
     * @param  Request  $request
     */
    #[Post(uri: 'member-sign-ups', name: 'api.v1.member-sign-ups', middleware: ['guest'])]
    public function __invoke(Request $request): void
    {

    }
}
