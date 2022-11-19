<?php

namespace App\Infrastructure\Members;

use Faker\Generator;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Model>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => null,
        ];
    }
}
