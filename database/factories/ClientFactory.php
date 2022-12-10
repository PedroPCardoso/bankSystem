<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\HistoricBalance;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'balance' => $this->faker->randomFloat(1, 20, 400),
            'user_id' => User::factory(),
            'historic_balance_id' => HistoricBalance::factory(),
        ];
    }
}
