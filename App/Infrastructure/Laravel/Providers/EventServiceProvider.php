<?php

declare(strict_types=1);

namespace Laravel\Providers;

use App\Application\Members\SendMemberActivationEmail;
use App\Domain\Members\MemberSignedUp;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MemberSignedUp::class => [
            SendMemberActivationEmail::class,
        ],
    ];
}
