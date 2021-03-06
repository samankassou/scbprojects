<?php

namespace Database\Factories;

use App\Models\ProcessVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcessVersionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProcessVersion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->sentence(),
            'version'   => $this->faker->numberBetween(1, 3),
            'type'      => $this->faker->randomElement([
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
            'created_by'               => $this->faker->name(),
            'written_by'               => $this->faker->name(),
            'approved_by'              => $this->faker->name(),
            'verified_by'              => $this->faker->name(),
            'creation_date'            => $this->faker->date(),
            'writing_date'             => $this->faker->date(),
            'verification_date'        => $this->faker->date(),
            'date_of_approval'         => $this->faker->date(),
            'broadcasting_date'        => $this->faker->date(),
            'state'                    => $this->faker->randomElement(['Créé', 'Revu']),
            'reasons_for_creation'     => $this->faker->paragraph(),
            'reasons_for_modification' => $this->faker->paragraph(),
            'appendices'               => $this->faker->paragraph(),
            'modifications'            => $this->faker->paragraph()
        ];
    }
}
