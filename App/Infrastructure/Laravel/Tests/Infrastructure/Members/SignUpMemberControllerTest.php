<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Members;

use App\Infrastructure\Members\Member;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class SignUpMemberControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_member_can_sign_up_for_a_new_account(): void
    {
        $member = Member::factory()->make();

        $response = $this->postJson(uri: $this->app->make(abstract: UrlGenerator::class)->route(name: 'api.v1.member-sign-ups', parameters: $member->toArray()));

        $this->assertDatabaseCount(table: 'users', count: 1);

        $this->assertDatabaseHas(table: 'users', data: Arr::except(array: $member->toArray(), keys: ['password']));

        $response->assertStatus(status: Response::HTTP_CREATED);
    }
}
