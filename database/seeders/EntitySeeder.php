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
            'name' => 'Direction de l\'Audit Interne',
            'pole_id' => $directionGenerale->id
        ]);
        Entity::create([
            'name' => 'Direction du Contrôle Interne',
            'pole_id' => $directionGenerale->id
        ]);
        Entity::create([
            'name' => 'Direction du Capital Interne',
            'pole_id' => $directionGenerale->id
        ]);
        Entity::create([
            'name' => 'Direction de la Conformité, Sécurité Financière & Déontologie',
            'pole_id' => $directionGenerale->id
        ]);
        Entity::create([
            'name' => 'Département du Conseil Juridique',
            'pole_id' => $directionGenerale->id
        ]);
        Entity::create([
            'name' => 'Département de la Communication & Qualité',
            'pole_id' => $directionGenerale->id
        ]);

        //pole 2
        $particuliersProfessionnelsEtTPE = Pole::firstWhere('name', 'Particuliers/Professionnels et TPE');
        Entity::create([
            'name' => 'Direction de la Distribution, des produits & du Marketing',
            'pole_id' => $particuliersProfessionnelsEtTPE->id
        ]);
        Entity::create([
            'name' => 'Entité Réseaux',
            'pole_id' => $particuliersProfessionnelsEtTPE->id
        ]);
        Entity::create([
            'name' => 'Service Supports & Moyens',
            'pole_id' => $particuliersProfessionnelsEtTPE->id
        ]);

        //pole 3
        $polesGrandesEntreprisesEtPME = Pole::firstWhere('name', 'Pôles Grandes Entreprises et PME');
        Entity::create([
            'name' => 'Grandes Entreprises & Institutionnels',
            'pole_id' => $polesGrandesEntreprisesEtPME->id
        ]);
        Entity::create([
            'name' => 'Petites & Moyennes Entreprises',
            'pole_id' => $polesGrandesEntreprisesEtPME->id
        ]);
        Entity::create([
            'name' => 'Activités de Marchés',
            'pole_id' => $polesGrandesEntreprisesEtPME->id
        ]);
        Entity::create([
            'name' => 'Services Financiers Spécialisés',
            'pole_id' => $polesGrandesEntreprisesEtPME->id
        ]);
        Entity::create([
            'name' => 'Cash Management & Trade Finance',
            'pole_id' => $polesGrandesEntreprisesEtPME->id
        ]);
        Entity::create([
            'name' => 'Pilotage de l\'activité',
            'pole_id' => $polesGrandesEntreprisesEtPME->id
        ]);

        //pole 4
        $engagements = Pole::firstWhere('name', 'Engagements');
        Entity::create([
            'name' => 'Direction du Recouvrement',
            'pole_id' => $engagements->id
        ]);
        Entity::create([
            'name' => 'Département Engagements',
            'pole_id' => $engagements->id
        ]);
        Entity::create([
            'name' => 'Département Audit des Engagements',
            'pole_id' => $engagements->id
        ]);
        Entity::create([
            'name' => 'Service Plate-Forme de Décision',
            'pole_id' => $engagements->id
        ]);

        //pole 5
        $finances = Pole::firstWhere('name', 'Finances');
        Entity::create([
            'name' => 'Direction Comptabilité',
            'pole_id' => $finances->id
        ]);
        Entity::create([
            'name' => 'Département Contrôle de Gestion & ALM',
            'pole_id' => $finances->id
        ]);
        Entity::create([
            'name' => 'Département Procédures & Contrôle Comptables',
            'pole_id' => $finances->id
        ]);
        Entity::create([
            'name' => 'Service Fiscalité',
            'pole_id' => $finances->id
        ]);
        Entity::create([
            'name' => 'Service Règlements Fournisseurs',
            'pole_id' => $finances->id
        ]);
        Entity::create([
            'name' => 'Service Assurances',
            'pole_id' => $finances->id
        ]);

        //pole 6
        $risques = Pole::firstWhere('name', 'Risques');
        Entity::create([
            'name' => 'Département Risques Informatiques et PCA',
            'pole_id' => $risques->id
        ]);
        Entity::create([
            'name' => 'Service Risques Opérationnels',
            'pole_id' => $risques->id
        ]);
        Entity::create([
            'name' => 'Service Risques de Contrepartie & de Marché',
            'pole_id' => $risques->id
        ]);

        //pole 7
        $support = Pole::firstWhere('name', 'Support');
        Entity::create([
            'name' => 'Direction Services & Traitements',
            'pole_id' => $support->id
        ]);
        Entity::create([
            'name' => 'Département Informatique',
            'pole_id' => $support->id
        ]);
        Entity::create([
            'name' => 'Département Organisation & Projets',
            'pole_id' => $support->id
        ]);
        Entity::create([
            'name' => 'Département Logistique',
            'pole_id' => $support->id
        ]);
        Entity::create([
            'name' => 'Service Achats',
            'pole_id' => $support->id
        ]);
        Entity::create([
            'name' => 'Service Gouvernance',
            'pole_id' => $support->id
        ]);
    }
}
