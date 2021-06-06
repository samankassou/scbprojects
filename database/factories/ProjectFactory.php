<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->sentence(),
            'description'   => $this->faker->text(),
            'start_date'    => $this->faker->dateTimeBetween('-3 years'),
            'end_date'      => $this->faker->dateTimeBetween('now', '+ 2years'),
            'sponsor'       => $this->faker->name(),
            'initiative'    => $this->faker->randomElement(['groupe', 'local']),
            'amoa'          => $this->faker->name(),
            'moe'           => $this->faker->name(),
            'manager'       => $this->faker->name(),
            'cost'          => $this->faker->numberBetween(0, 1000000000),
            'status'        => 'en cours',
            'progress'      => $this->faker->numberBetween(0, 80),
            'benefits'      => $this->faker->text(),
            'saved_by'      => User::all()->random()->id,
            'documentation' => $this->faker->text(),
            'bills'         => $this->faker->text()

        ];
    }
}
