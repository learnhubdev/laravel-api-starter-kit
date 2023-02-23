<?php

declare(strict_types=1);

namespace App\Infrastructure\Authentication;

use App\Domain\Members\StatusName;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->freeEmail(),
            'password' => $this->faker->password(minLength: 8),
            'status' => StatusName::PENDING->value,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => null,
            'remember_token' => Str::random(length: 10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): self
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
