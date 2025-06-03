<?php

namespace Database\Factories;

use App\Models\Teams;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teams>
 */
class TeamsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Teams::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->unique()->slug(),
            'logo' => Teams::findOrFail(1)->logo,
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => 1
        ];
    }
}
