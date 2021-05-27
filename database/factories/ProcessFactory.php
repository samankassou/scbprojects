<?php

namespace Database\Factories;

use App\Models\Entity;
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
              'name' => $this->faker->sentence(),
              'reference' => $this->faker->numberBetween(1, 1000),
              'version' => $this->faker->numberBetween(1, 3),
              'type' => $this->faker->randomElement([
                  'Note de procédure',
                  'Note de fonctionnement',
                  'Note circulaire',
                  'Instruction à durée limitée',
                  'Fiche de décision'
                  ]),
               'status' => $this->faker->randomElement([
                   'Existant',
                   'A créer',
                   'En cours de rédaction',
                   'En cours de vérification',
                   'En cours d\'approbation',
                   'En stand-by',
                   'Terminé'
                   ]),
                'created_by' => $this->faker->name(),
                'written_by' => $this->faker->name(),
                'approved_by' => $this->faker->name(),
                'validated_by' => $this->faker->name(),
                'creation_date' => $this->faker->date(),
                'written_date' => $this->faker->date(),
                'validation_date' => $this->faker->date(),
                'approved_date' => $this->faker->date(),
                'diffusion_date' => $this->faker->date(),
                'state' => $this->faker->randomElement(['Créé', 'Revu']),
                'reasons_for_creation' => $this->faker->paragraph(),
                'reasons_for_modification' => $this->faker->paragraph(),
                'appendices' => $this->faker->paragraph(),
                'method_id' => Method::all()->random()->id,
                'entity_id' => Entity::all()->random()->id,
        ];
    }
}
