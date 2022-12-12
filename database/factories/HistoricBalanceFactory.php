<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HistoricBalance;
use Illuminate\Support\Str;
use App\Models\Client;

class HistoricBalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount'=> $this->faker->randomFloat(1, 20, 10),
            'type' => rand(0, 1) ?  HistoricBalance::TYPE_DEPOSIT : HistoricBalance::TYPE_PAYMENT,
            'Description'=> Str::random(10),
            'client_id' => 1,

        ];
    }
}
