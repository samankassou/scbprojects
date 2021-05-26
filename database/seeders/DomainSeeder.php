<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domain::create(['name' => 'Achats & Moyens Généraux']);
        Domain::create(['name' => 'Caisse']);
        Domain::create(['name' => 'Clients']);
        Domain::create(['name' => 'Commercial']);
        Domain::create(['name' => 'Engagements']);
        Domain::create(['name' => 'E-Banking']);
        Domain::create(['name' => 'Finance et comptabilité']);
        Domain::create(['name' => 'Juridique']);
        Domain::create(['name' => 'Marchés, Financement & Titres']);
        Domain::create(['name' => 'Marketing et Communication']);
        Domain::create(['name' => 'Opérations Bancaires']);
        Domain::create(['name' => 'Opérations Interbancaires']);
        Domain::create(['name' => 'Organisation']);
        Domain::create(['name' => 'Recouvrement']);
        Domain::create(['name' => 'Ressources Humaines']);
        Domain::create(['name' => 'Risque']);
        Domain::create(['name' => 'SI']);
    }
}
