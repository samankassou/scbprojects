<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Pole;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pole 1
        $directionGenerale = Pole::firstWhere('name', 'Direction Générale');
        Entity::create([
            'name' => 'Entité A',
            'pole_id' => $directionGenerale->id
        ]);
        Entity::create([
            'name' => 'Entité B',
            'pole_id' => $directionGenerale->id
        ]);

        //pole 2
        $polesGrandesEntreprisesEtPME = Pole::firstWhere('name', 'Pôles Grandes Entreprises et PME');

        //pole 3
        $polesGrandesEntreprisesEtPME = Pole::firstWhere('name', 'Particuliers/Professionnels et TPE');

        //pole 4
        $engagements = Pole::firstWhere('name', 'Engagements');

        //pole 5
        $finances = Pole::firstWhere('name', 'Finances');

        //pole 6
        $risques = Pole::firstWhere('name', 'Risques');

        //pole 7
        $support = Pole::firstWhere('name', 'Support');
    }
}
