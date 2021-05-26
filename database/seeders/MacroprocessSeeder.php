<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Macroprocess;
use Illuminate\Database\Seeder;

class MacroprocessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //domain 1
        $achatsMoyensGeneraux = Domain::firstWhere('name', 'Achats & Moyens Généraux');
        Macroprocess::create([
            'name' => 'Achats',
            'domain_id' => $achatsMoyensGeneraux->id
        ]);
        Macroprocess::create([
            'name' => 'Aménagement',
            'domain_id' => $achatsMoyensGeneraux->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion du patrimoine',
            'domain_id' => $achatsMoyensGeneraux->id
        ]);
        Macroprocess::create([
            'name' => 'Logistique',
            'domain_id' => $achatsMoyensGeneraux->id
        ]);
        Macroprocess::create([
            'name' => 'Moyens généraux ',
            'domain_id' => $achatsMoyensGeneraux->id
        ]);

        //domain 2
        $caisse = Domain::firstWhere('name', 'Caisse');
        Macroprocess::create([
            'name' => 'Gestion des opérations de caisse',
            'domain_id' => $caisse->id
        ]);

        //domain 3
        $clients = Domain::firstWhere('name', 'Clients');
        Macroprocess::create([
            'name' => 'Gestion des comptes de la clientèle',
            'domain_id' => $clients->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des réclamations',
            'domain_id' => $clients->id
        ]);

        //domain 4
        $commercial = Domain::firstWhere('name', 'Commercial');
        Macroprocess::create([
            'name' => 'Gestion de la relation client',
            'domain_id' => $commercial->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des produits et services',
            'domain_id' => $commercial->id
        ]);

        //domain 5
        $eBanking = Domain::firstWhere('name', 'E-Banking');
        Macroprocess::create([
            'name' => 'Gestion des services E-Banking',
            'domain_id' => $eBanking->id
        ]);

        //domain 6
        $engagements = Domain::firstWhere('name', 'Engagements');
        Macroprocess::create([
            'name' => 'Gestion des engagements',
            'domain_id' => $engagements->id
        ]);


        //domain 7
        $financeComptabilite = Domain::firstWhere('name', 'Finance et comptabilité');
        Macroprocess::create([
            'name' => 'Analyse et conseil financier',
            'domain_id' => $financeComptabilite->id
        ]);
        Macroprocess::create([
            'name' => 'Contrôle de gestion',
            'domain_id' => $financeComptabilite->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion de la comptabilité',
            'domain_id' => $financeComptabilite->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des reportings financiers',
            'domain_id' => $financeComptabilite->id
        ]);

        //domain 8
        $juridique = Domain::firstWhere('name', 'Juridique');
        Macroprocess::create([
            'name' => 'Assistance et actes juridiques',
            'domain_id' => $juridique->id
        ]);
        Macroprocess::create([
            'name' => 'Corporate Management',
            'domain_id' => $juridique->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des affaires judiciaires',
            'domain_id' => $juridique->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des projets et de la veille juridique',
            'domain_id' => $juridique->id
        ]);

        //domain 9
        $marcheFinancementTitre = Domain::firstWhere('name', 'Marchés, Financement & Titres');
        Macroprocess::create([
            'name' => 'Gestion des opérations de marché',
            'domain_id' => $marcheFinancementTitre->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des opérations sur Titres et valeurs mobilières',
            'domain_id' => $marcheFinancementTitre->id
        ]);

        //domain 10
        $marketingEtCommunication = Domain::firstWhere('name', 'Marketing et Communication');
        Macroprocess::create([
            'name' => 'Gestion de la communication externe',
            'domain_id' => $marketingEtCommunication->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion du marketing',
            'domain_id' => $marketingEtCommunication->id
        ]);

        //domain 11
        $operationsBancaires = Domain::firstWhere('name', 'Opérations Bancaires');
        Macroprocess::create([
            'name' => 'Gestion des incidents de paiement',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion de la monétique',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des interdits bancaires',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Cash transfert',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des moyens de paiement',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des opérations internationales',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des reportings',
            'domain_id' => $operationsBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des opérations locales',
            'domain_id' => $operationsBancaires->id
        ]);

        //domain 12
        $operationsInterBancaires = Domain::firstWhere('name', 'Opérations Interbancaires');
        Macroprocess::create([
            'name' => 'Gestion des comptes correspondants',
            'domain_id' => $operationsInterBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des prêts syndiqués',
            'domain_id' => $operationsInterBancaires->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des opérations sur le marché interbancaire',
            'domain_id' => $operationsInterBancaires->id
        ]);

        //domain 13
        $organisation = Domain::firstWhere('name', 'Organisation');
        Macroprocess::create([
            'name' => 'Développement et pilotage de projets',
            'domain_id' => $organisation->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des normes et référentiels',
            'domain_id' => $organisation->id
        ]);

        //domain 14
        $recouvrement = Domain::firstWhere('name', 'Recouvrement');
        Macroprocess::create([
            'name' => 'Gestion du recouvrement',
            'domain_id' => $recouvrement->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des reportings',
            'domain_id' => $recouvrement->id
        ]);

        //domain 15
        $ressourcesHumaines = Domain::firstWhere('name', 'Ressources Humaines');
        Macroprocess::create([
            'name' => 'Gestion de la communication interne',
            'domain_id' => $ressourcesHumaines->id
        ]);
        Macroprocess::create([
            'name' => 'Développement RH',
            'domain_id' => $ressourcesHumaines->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion des relations et oeuvres sociales',
            'domain_id' => $ressourcesHumaines->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion du personnel et de la paie',
            'domain_id' => $ressourcesHumaines->id
        ]);

        //domain 16
        $risque = Domain::firstWhere('name', 'Risque');
        Macroprocess::create([
            'name' => 'Suivi des risques',
            'domain_id' => $risque->id
        ]);

        //domain 17
        $si = Domain::firstWhere('name', 'SI');
        Macroprocess::create([
            'name' => 'Développement et pilotage de projets',
            'domain_id' => $si->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion de la sécurité informatique',
            'domain_id' => $si->id
        ]);
        Macroprocess::create([
            'name' => 'Stratégie et pilotage SI',
            'domain_id' => $si->id
        ]);
        Macroprocess::create([
            'name' => 'Gestion de l\'exploitation',
            'domain_id' => $si->id
        ]);
    }
}
