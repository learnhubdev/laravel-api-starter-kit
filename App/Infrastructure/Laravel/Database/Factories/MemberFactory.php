<?php

namespace Laravel\Database\Factories;

use App\Infrastructure\Members\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

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
            'last_name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->freeEmail(),
            'password' => $this->faker->password(),
        ];
    }
}
