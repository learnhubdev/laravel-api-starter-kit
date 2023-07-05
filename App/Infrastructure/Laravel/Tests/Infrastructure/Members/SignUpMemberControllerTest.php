<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Members;

use App\Infrastructure\Members\Member;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Testing\Fakes\MailFake;
use Illuminate\Support\Testing\Fakes\QueueFake;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class SignUpMemberControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * The Illuminate application instance.
     */
    protected $app;

    public function setUp(): void
    {
        parent::setUp();

        $this->app = $this->createApplication();
        $this->app->bind(abstract: Mailer::class, concrete: MailFake::class);
        $this->app->bind(abstract: Queue::class, concrete: fn () => new QueueFake(app: $this->app));
    }

    /**
     * @test
     */
    public function a_member_can_sign_up_for_a_new_account(): void
    {
        $member = Member::factory()->make();

        $response = $this->postJson(
            uri: $this->app->make(
                abstract: UrlGenerator::class
            )->route(
                name: 'api.v1.member-sign-ups',
                parameters: array_merge($member->toArray(), ['password_confirmation' => $member->password])
            )
        );

        $this->assertDatabaseCount(table: 'users', count: 1);

        $this->assertDatabaseHas(table: 'users', data: Arr::except(array: $member->toArray(), keys: ['password', 'password_confirmation']));

        $response->assertStatus(status: Response::HTTP_CREATED);
    }

    /**
     * @test
     *
     * @dataProvider signUpMemberDataProvider
     */
    public function sign_up_member_validation_errors(string $field, mixed $value, string $errorField = ''): void
    {
        $member = Member::factory()->make();

        $parameters = array_merge($member->toArray(), [$field => $value]);

        $response = $this->postJson(uri: $this->app->make(abstract: UrlGenerator::class)->route(name: 'api.v1.member-sign-ups', parameters: $parameters));

        $this->assertDatabaseMissing(table: 'users', data: Arr::except(array: $member->toArray(), keys: ['password']));

        $response->assertStatus(status: Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(errors: $errorField ?: $field);
    }

    public static function signUpMemberDataProvider(): array
    {
        return [
            'The first name field is required' => ['first_name', ''],
            'The first name may not be greater than 100 characters' => [
                'first_name',
                str_repeat(string: 'a', times: 110),
            ],
            'The last name field is required' => ['last_name', ''],
            'The last name may not be greater than 50 characters' => [
                'last_name',
                str_repeat(string: 'a', times: 110),
            ],
            'The email field is required' => ['email', ''],
            'The email may not be greater than 200 characters' => [
                'email',
                str_repeat(string: 'a', times: 210),
            ],
            'The email must be a valid email address (format)' => ['email', 'invalidemailaddress'],
            'The email must be a valid email address (domain)' => ['email', 'test@invaliddomainthatdoesnotexist.com'],
            'The email must be a valid email address (RFC)' => ['email', 'p[][;lp@example.com'],
            'The email has already been taken' => ['email', 'test@example.com'],
            'The password must be at least 8 characters' => ['password', 'secret'],
            'The password confirmation does not match' => ['password_confirmation', 'Secret111', 'password'],
        ];
    }
}
