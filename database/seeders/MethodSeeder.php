<?php

namespace Database\Seeders;

use App\Models\Macroprocess;
use App\Models\Method;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //macroprocess 1
        $achats = Macroprocess::firstWhere('name', 'Achats');
        Method::create([
            'name' => 'Gestion des achats',
            'macroprocess_id' => $achats->id
        ]);
        Method::create([
            'name' => 'Gestion des prestataires',
            'macroprocess_id' => $achats->id
        ]);

        //macroprocess 2
        $amenagements = Macroprocess::firstWhere('name', 'Aménagement');
        Method::create([
            'name' => 'Aménagement des sites',
            'macroprocess_id' => $amenagements->id
        ]);
        Method::create([
            'name' => 'Gestion de la maintenance et de l\'entretien des sites',
            'macroprocess_id' => $amenagements->id
        ]);
        Method::create([
            'name' => 'Gestion des investissements pour aménagement',
            'macroprocess_id' => $amenagements->id
        ]);
        Method::create([
            'name' => 'Gestion et pilotage des projets de développement et de conception',
            'macroprocess_id' => $amenagements->id
        ]);

        //macroprocess 3
        $analyseEtConseilFinacier = Macroprocess::firstWhere('name', 'Analyse et conseil financier');
        Method::create([
            'name' => 'Conseil Fiscal',
            'macroprocess_id' => $analyseEtConseilFinacier->id
        ]);
        Method::create([
            'name' => 'Gestion de l\'information financière',
            'macroprocess_id' => $analyseEtConseilFinacier->id
        ]);

        //macroprocess 4
        $assistanceEtActesJuridiques = Macroprocess::firstWhere('name', 'Assistance et actes juridiques');
        Method::create([
            'name' => 'Gestion des mainlevées',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des ATD',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des saisies arrêts',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des successions',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des contrats',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des droits de communication',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des convocations judiciaires',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Gestion des réquisitions judiciaires',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);
        Method::create([
            'name' => 'Traitement des consultations',
            'macroprocess_id' => $assistanceEtActesJuridiques->id
        ]);

        //macroprocess 5
        $cashTransfert = Macroprocess::firstWhere('name', 'Cash transfert');
        Method::create([
            'name' => 'Elaboration des contrats Cash transfert',
            'macroprocess_id' => $cashTransfert->id
        ]);
        Method::create([
            'name' => 'Paramétrage du système Cash transfert',
            'macroprocess_id' => $cashTransfert->id
        ]);
        Method::create([
            'name' => 'Retrait des fonds Cash transfert',
            'macroprocess_id' => $cashTransfert->id
        ]);
        Method::create([
            'name' => 'Emission des fonds Cash transfert',
            'macroprocess_id' => $cashTransfert->id
        ]);

        //macroprocess 6
        $controleDeGestion = Macroprocess::firstWhere('name', 'Contrôle de gestion');
        Method::create([
            'name' => 'Comptabilité analytique',
            'macroprocess_id' => $controleDeGestion->id
        ]);
        Method::create([
            'name' => 'Gestion Actif Passif (ALM)',
            'macroprocess_id' => $controleDeGestion->id
        ]);
        Method::create([
            'name' => 'Management reporting',
            'macroprocess_id' => $controleDeGestion->id
        ]);
        Method::create([
            'name' => 'Planification financière et élaboration des budgets/forecast bancaires',
            'macroprocess_id' => $controleDeGestion->id
        ]);
        Method::create([
            'name' => 'Suivi et contrôle budgétaire',
            'macroprocess_id' => $controleDeGestion->id
        ]);

        //macroprocess 7
        $corporateManagement = Macroprocess::firstWhere('name', 'Corporate Management');
        Method::create([
            'name' => 'Gestion Capital Marque',
            'macroprocess_id' => $corporateManagement->id
        ]);
        Method::create([
            'name' => 'Gestion des opérations sur capital',
            'macroprocess_id' => $corporateManagement->id
        ]);
        Method::create([
            'name' => 'Gestion des pouvoirs',
            'macroprocess_id' => $corporateManagement->id
        ]);
        Method::create([
            'name' => 'Mise à jour du dossier juridique de la banque',
            'macroprocess_id' => $corporateManagement->id
        ]);
        //macroprocess 8
        $developpementEtPilotageDeProjets = Macroprocess::firstWhere('name', 'Développement et pilotage de projets');
        Method::create([
            'name' => 'Gestion de projet',
            'macroprocess_id' => $developpementEtPilotageDeProjets->id
        ]);
        Method::create([
            'name' => 'Gestion applicative',
            'macroprocess_id' => $developpementEtPilotageDeProjets->id
        ]);
        Method::create([
            'name' => 'Gestion de projets SI',
            'macroprocess_id' => $developpementEtPilotageDeProjets->id
        ]);

        //macroprocess 9
        $developpementRH = Macroprocess::firstWhere('name', 'Développement RH');
        Method::create([
            'name' => 'Gestion de la formation',
            'macroprocess_id' => $developpementRH->id
        ]);
        Method::create([
            'name' => 'Gestion de la carrière',
            'macroprocess_id' => $developpementRH->id
        ]);
        Method::create([
            'name' => 'Gestion de la mobilité',
            'macroprocess_id' => $developpementRH->id
        ]);
        Method::create([
            'name' => 'Gestion des évaluations et management de la performance',
            'macroprocess_id' => $developpementRH->id
        ]);
        Method::create([
            'name' => 'Gestion du recrutement',
            'macroprocess_id' => $developpementRH->id
        ]);

        //macroprocess 10
        $gestionDeLaCommunicationExterne = Macroprocess::firstWhere('name', 'Gestion de la communication externe');
        Method::create([
            'name' => 'Gestion de la communication financière',
            'macroprocess_id' => $gestionDeLaCommunicationExterne->id
        ]);
        Method::create([
            'name' => 'Gestion de la marque institutionnelle',
            'macroprocess_id' => $gestionDeLaCommunicationExterne->id
        ]);
        Method::create([
            'name' => 'Gestion des événements externes',
            'macroprocess_id' => $gestionDeLaCommunicationExterne->id
        ]);
    }
}
