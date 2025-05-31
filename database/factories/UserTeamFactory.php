<?php

namespace Database\Factories;

use App\Models\Teams;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTeams>
 */
class UserTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserTeam::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'team_id' => Teams::inRandomOrder()->first()->id,
        ];
    }
}
