<?php

namespace Database\Factories;

use App\Models\Method;
use App\Models\Process;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Process::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'method_id' => Method::all()->random()->id,
            'reference' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
