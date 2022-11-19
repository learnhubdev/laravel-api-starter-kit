<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Tests\Infrastructure\Members;

use App\Domain\Members\EmailAddress;
use App\Domain\Members\FirstName;
use App\Domain\Members\Id;
use App\Domain\Members\LastName;
use App\Domain\Members\Member;
use App\Domain\Members\MemberReadModel;
use App\Domain\Members\MemberWasNotFound;
use App\Domain\Members\Password;
use App\Infrastructure\Members\EloquentMemberRepository;
use App\Infrastructure\Members\Member as EloquentMember;
use Assert\AssertionFailedException;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Hashing\BcryptHasher;
use Symfony\Component\Clock\NativeClock;
use Tests\TestCase;

final class EloquentMemberRepositoryTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->memberRepository = new EloquentMemberRepository(new EloquentMember());
        $this->clock = new NativeClock();
        $this->hasher = new BcryptHasher();
        $this->snowflake = new Snowflake();
    }

    /** @test */
    public function it_can_generate_an_identity(): void
    {
        $identity = $this->memberRepository->generateIdentity();

        $this->assertNotNull(actual: $identity);
    }

    /**
     * @test
     *
     * @throws MemberWasNotFound
     * @throws AssertionFailedException
     */
    public function it_can_find_a_member_by_email_address(): void
    {
        $member = EloquentMember::factory()->create(attributes: [
            'id' => $this->snowflake->id(),
        ]);

        $memberReadModel = $this->memberRepository->findByEmailAddress(emailAddress: $member->email);

        $this->assertNotNull(actual: $memberReadModel);
        $this->assertInstanceOf(expected: MemberReadModel::class, actual: $memberReadModel);
        $this->assertEquals(expected: $member->email, actual: $memberReadModel->getEmailAddress()->getValue());
    }

    /**
     * @test
     *
     * @throws AssertionFailedException
     */
    public function it_cannot_find_a_member_by_email_address_that_does_not_exist(): void
    {
        $this->expectException(exception: MemberWasNotFound::class);
        $this->expectExceptionMessage(message: 'The member was not found.');

        $this->memberRepository->findByEmailAddress(emailAddress: 'myemail@gmail.com');
    }

    /** @test
     * @throws AssertionFailedException
     */
    public function it_can_save_a_new_member_in_the_database(): void
    {
        $eloquentMember = EloquentMember::factory()->make();

        $member = Member::signUp(
            id: Id::createFromString(value: $this->memberRepository->generateIdentity()),
            firstName: FirstName::createFromString(value: $eloquentMember->first_name),
            lastName: LastName::createFromString(value: $eloquentMember->last_name),
            emailAddress: EmailAddress::createFromString(value: $eloquentMember->email),
            createdAt: $this->clock->now(),
            updatedAt: $this->clock->now(),
            password: Password::createFromString(value: $this->hasher->make(value: $eloquentMember->password))
        );

        $this->memberRepository->save($member);

        $this->assertDatabaseCount(table: 'users', count: 1);
        $this->assertDatabaseHas(table: 'users', data: $member->mapForPersistence());
    }

    /**
     * @test
     */
    public function it_returns_true_if_a_member_exists_by_email_address(): void
    {
        $member = EloquentMember::factory()->create(attributes: [
            'id' => $this->snowflake->id(),
        ]);

        $memberExists = $this->memberRepository->existsByEmailAddress(emailAddress: $member->email);

        $this->assertTrue($memberExists);
    }

    /**
     * @test
     */
    public function it_returns_false_if_a_member_does_not_exist_by_email_address(): void
    {
        EloquentMember::factory()->create(attributes: [
            'id' => $this->snowflake->id(),
        ]);

        $memberExists = $this->memberRepository->existsByEmailAddress(emailAddress: 'something@gmail.com');

        $this->assertFalse($memberExists);
    }
}
