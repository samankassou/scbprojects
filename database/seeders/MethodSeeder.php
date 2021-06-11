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
        $macroprocess1 = Macroprocess::firstWhere('name', 'Achats');
        Method::create([
            'name' => 'Gestion des achats',
            'macroprocess_id' => $macroprocess1->id
        ]);
        Method::create([
            'name' => 'Gestion des prestataires',
            'macroprocess_id' => $macroprocess1->id
        ]);

        //macroprocess 2
        $macroprocess2 = Macroprocess::firstWhere('name', 'Aménagement');
        Method::create([
            'name' => 'Aménagement des sites',
            'macroprocess_id' => $macroprocess2->id
        ]);
        Method::create([
            'name' => 'Gestion de la maintenance et de l\'entretien des sites',
            'macroprocess_id' => $macroprocess2->id
        ]);
        Method::create([
            'name' => 'Gestion des investissements pour aménagement',
            'macroprocess_id' => $macroprocess2->id
        ]);
        Method::create([
            'name' => 'Gestion et pilotage des projets de développement et de conception',
            'macroprocess_id' => $macroprocess2->id
        ]);

        //macroprocess 3
        $macroprocess3 = Macroprocess::firstWhere('name', 'Analyse et conseil financier');
        Method::create([
            'name' => 'Conseil Fiscal',
            'macroprocess_id' => $macroprocess3->id
        ]);
        Method::create([
            'name' => 'Gestion de l\'information financière',
            'macroprocess_id' => $macroprocess3->id
        ]);

        //macroprocess 4
        $macroprocess4 = Macroprocess::firstWhere('name', 'Assistance et actes juridiques');
        Method::create([
            'name' => 'Gestion des mainlevées',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des ATD',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des saisies arrêts',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des successions',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des contrats',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des droits de communication',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des convocations judiciaires',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Gestion des réquisitions judiciaires',
            'macroprocess_id' => $macroprocess4->id
        ]);
        Method::create([
            'name' => 'Traitement des consultations',
            'macroprocess_id' => $macroprocess4->id
        ]);

        //macroprocess 5
        $macroprocess5 = Macroprocess::firstWhere('name', 'Cash transfert');
        Method::create([
            'name' => 'Elaboration des contrats Cash transfert',
            'macroprocess_id' => $macroprocess5->id
        ]);
        Method::create([
            'name' => 'Paramétrage du système Cash transfert',
            'macroprocess_id' => $macroprocess5->id
        ]);
        Method::create([
            'name' => 'Retrait des fonds Cash transfert',
            'macroprocess_id' => $macroprocess5->id
        ]);
        Method::create([
            'name' => 'Emission des fonds Cash transfert',
            'macroprocess_id' => $macroprocess5->id
        ]);

        //macroprocess 6
        $macroprocess6 = Macroprocess::firstWhere('name', 'Contrôle de gestion');
        Method::create([
            'name' => 'Comptabilité analytique',
            'macroprocess_id' => $macroprocess6->id
        ]);
        Method::create([
            'name' => 'Gestion Actif Passif (ALM)',
            'macroprocess_id' => $macroprocess6->id
        ]);
        Method::create([
            'name' => 'Management reporting',
            'macroprocess_id' => $macroprocess6->id
        ]);
        Method::create([
            'name' => 'Planification financière et élaboration des budgets/forecast bancaires',
            'macroprocess_id' => $macroprocess6->id
        ]);
        Method::create([
            'name' => 'Suivi et contrôle budgétaire',
            'macroprocess_id' => $macroprocess6->id
        ]);

        //macroprocess 7
        $macroprocess7 = Macroprocess::firstWhere('name', 'Corporate Management');
        Method::create([
            'name' => 'Gestion Capital Marque',
            'macroprocess_id' => $macroprocess7->id
        ]);
        Method::create([
            'name' => 'Gestion des opérations sur capital',
            'macroprocess_id' => $macroprocess7->id
        ]);
        Method::create([
            'name' => 'Gestion des pouvoirs',
            'macroprocess_id' => $macroprocess7->id
        ]);
        Method::create([
            'name' => 'Mise à jour du dossier juridique de la banque',
            'macroprocess_id' => $macroprocess7->id
        ]);
        //macroprocess 8
        $macroprocess8 = Macroprocess::where('name', 'Développement et pilotage de projets')->get()->last();
        Method::create([
            'name' => 'Gestion applicative',
            'macroprocess_id' => $macroprocess8->id
        ]);
        Method::create([
            'name' => 'Gestion de projets SI',
            'macroprocess_id' => $macroprocess8->id
        ]);

        //macroprocess 9
        $macroprocess9 = Macroprocess::firstWhere('name', 'Développement RH');
        Method::create([
            'name' => 'Gestion de la formation',
            'macroprocess_id' => $macroprocess9->id
        ]);
        Method::create([
            'name' => 'Gestion de la carrière',
            'macroprocess_id' => $macroprocess9->id
        ]);
        Method::create([
            'name' => 'Gestion de la mobilité',
            'macroprocess_id' => $macroprocess9->id
        ]);
        Method::create([
            'name' => 'Gestion des évaluations et management de la performance',
            'macroprocess_id' => $macroprocess9->id
        ]);
        Method::create([
            'name' => 'Gestion du recrutement',
            'macroprocess_id' => $macroprocess9->id
        ]);

        //macroprocess 10
        $macroprocess10 = Macroprocess::firstWhere('name', 'Gestion de la communication externe');
        Method::create([
            'name' => 'Gestion de la communication financière',
            'macroprocess_id' => $macroprocess10->id
        ]);
        Method::create([
            'name' => 'Gestion de la marque institutionnelle',
            'macroprocess_id' => $macroprocess10->id
        ]);
        Method::create([
            'name' => 'Gestion des événements externes',
            'macroprocess_id' => $macroprocess10->id
        ]);

        //macroprocess 11
        $macroprocess11 = Macroprocess::firstWhere('name', 'Gestion de la communication interne');
        Method::create([
            'name' => 'Conception et diffusion des supports de communication interne',
            'macroprocess_id' => $macroprocess11->id
        ]);
        Method::create([
            'name' => 'Organisation des événements internes',
            'macroprocess_id' => $macroprocess11->id
        ]);

        //macroprocess 12
        $macroprocess12 = Macroprocess::firstWhere('name', 'Gestion de la monétique');
        Method::create([
            'name' => 'Gestion de la sécurité monétique',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Gestion des cartes monétiques',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Gestion des GAB',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Gestion des reportings monétiques',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Gestion des projets Monétique',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Mise à disposition GAB',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Traitement comptable de la monétique (y compris compensation monétique)',
            'macroprocess_id' => $macroprocess12->id
        ]);
        Method::create([
            'name' => 'Gestion des services Mobile Money',
            'macroprocess_id' => $macroprocess12->id
        ]);

        //macroprocess 13
        $macroprocess13 = Macroprocess::firstWhere('name', 'Gestion de la relation client');
        Method::create([
            'name' => 'Canal digital',
            'macroprocess_id' => $macroprocess13->id
        ]);
        Method::create([
            'name' => 'Connaissance et parcours client',
            'macroprocess_id' => $macroprocess13->id
        ]);
        Method::create([
            'name' => 'Gestion de la relation client (inactivité)',
            'macroprocess_id' => $macroprocess13->id
        ]);
        Method::create([
            'name' => 'Segmentation client',
            'macroprocess_id' => $macroprocess13->id
        ]);

        //macroprocess 14
        $macroprocess14 = Macroprocess::firstWhere('name', 'Gestion de la sécurité informatique');
        Method::create([
            'name' => 'Gestion des accès et habilitations',
            'macroprocess_id' => $macroprocess14->id
        ]);
        Method::create([
            'name' => 'Gestion de la sécurité infrastructure/système',
            'macroprocess_id' => $macroprocess14->id
        ]);

        //macroprocess 15
        $macroprocess15 = Macroprocess::firstWhere('name', 'Gestion de l\'exploitation');
        Method::create([
            'name' => 'Gestion des incidents',
            'macroprocess_id' => $macroprocess15->id
        ]);
        Method::create([
            'name' => 'Gestion de la continuité et de la disponibilité des systèmes',
            'macroprocess_id' => $macroprocess15->id
        ]);
        Method::create([
            'name' => 'Gestion des infrastructures techniques',
            'macroprocess_id' => $macroprocess15->id
        ]);
        Method::create([
            'name' => 'Gestion des services (support utilisateur)',
            'macroprocess_id' => $macroprocess15->id
        ]);

        //macroprocess 16
        $macroprocess16 = Macroprocess::firstWhere('name', 'Gestion des affaires judiciaires');
        Method::create([
            'name' => 'Traitement des litiges',
            'macroprocess_id' => $macroprocess16->id
        ]);

        //macroprocess 17
        $macroprocess17 = Macroprocess::firstWhere('name', 'Gestion de la comptabilité');
        Method::create([
            'name' => 'Comptabilisation',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Contrôle et Rapprochement Comptable',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Gestion DAT et Bons de caisses',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Gestion des immobilisations',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Gestion des participations',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Gestion du portefeuille titre',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Opérations spéciales et litigieuses',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Paiement des taxes et impôts',
            'macroprocess_id' => $macroprocess17->id
        ]);
        Method::create([
            'name' => 'Règlement fournisseurs et facturation',
            'macroprocess_id' => $macroprocess17->id
        ]);

        //macroprocess 18
        $macroprocess18 = Macroprocess::firstWhere('name', 'Gestion des comptes correspondants');
        Method::create([
            'name' => 'Clôture du compte correspondant',
            'macroprocess_id' => $macroprocess18->id
        ]);
        Method::create([
            'name' => 'Entrée en relation avec un correspondant bancaire',
            'macroprocess_id' => $macroprocess18->id
        ]);
        Method::create([
            'name' => 'Gestion des demandes',
            'macroprocess_id' => $macroprocess18->id
        ]);
        Method::create([
            'name' => 'Ouverture de compte correspondant',
            'macroprocess_id' => $macroprocess18->id
        ]);
        Method::create([
            'name' => 'Suivi du compte correspondant',
            'macroprocess_id' => $macroprocess18->id
        ]);

        //macroprocess 19
        $macroprocess19 = Macroprocess::firstWhere('name', 'Gestion des comptes de la clientèle');
        Method::create([
            'name' => 'Entrée en relation et ouverture de compte',
            'macroprocess_id' => $macroprocess19->id
        ]);
        Method::create([
            'name' => 'Suivi du compte',
            'macroprocess_id' => $macroprocess19->id
        ]);
        Method::create([
            'name' => 'Gestion des demandes clients',
            'macroprocess_id' => $macroprocess19->id
        ]);
        Method::create([
            'name' => 'Gestion des données clients',
            'macroprocess_id' => $macroprocess19->id
        ]);
        Method::create([
            'name' => 'Incidents sur comptes',
            'macroprocess_id' => $macroprocess19->id
        ]);
        Method::create([
            'name' => 'Clôture des comptes',
            'macroprocess_id' => $macroprocess19->id
        ]);
        Method::create([
            'name' => 'Gel des comptes client',
            'macroprocess_id' => $macroprocess19->id
        ]);

        //macroprocess 20
        $macroprocess20 = Macroprocess::firstWhere('name', 'Gestion des engagements');
        Method::create([
            'name' => 'Contractualisation et constitution des garanties',
            'macroprocess_id' => $macroprocess20->id
        ]);
        Method::create([
            'name' => 'Mise en place et déblocage du prêt',
            'macroprocess_id' => $macroprocess20->id
        ]);
        Method::create([
            'name' => 'Demande et étude du dossier de crédit',
            'macroprocess_id' => $macroprocess20->id
        ]);
        Method::create([
            'name' => 'Gestion des cautions et avals ',
            'macroprocess_id' => $macroprocess20->id
        ]);
        Method::create([
            'name' => 'Gestion des encours',
            'macroprocess_id' => $macroprocess20->id
        ]);
        Method::create([
            'name' => 'Gestion et suivi des garanties',
            'macroprocess_id' => $macroprocess20->id
        ]);

        //macroprocess 21
        $macroprocess21 = Macroprocess::firstWhere('name', 'Gestion des incidents de paiement');
        Method::create([
            'name' => 'Déclaration des incidents de paiement',
            'macroprocess_id' => $macroprocess21->id
        ]);
        Method::create([
            'name' => 'Annulation des incidents de paiement',
            'macroprocess_id' => $macroprocess21->id
        ]);
        Method::create([
            'name' => 'Gestion des incidents de paiement',
            'macroprocess_id' => $macroprocess21->id
        ]);
        Method::create([
            'name' => 'Régularisation des incidents de paiement',
            'macroprocess_id' => $macroprocess21->id
        ]);

        //macroprocess 22
        $macroprocess22 = Macroprocess::firstWhere('name', 'Gestion des interdits bancaires');
        Method::create([
            'name' => 'Gestion des clients interdits bancaires',
            'macroprocess_id' => $macroprocess22->id
        ]);

        //macroprocess 23
        $macroprocess23 = Macroprocess::firstWhere('name', 'Gestion des moyens de paiement');
        Method::create([
            'name' => 'Conservation des moyens de paiement',
            'macroprocess_id' => $macroprocess23->id
        ]);
        Method::create([
            'name' => 'Gestion des chèques et des effets',
            'macroprocess_id' => $macroprocess23->id
        ]);
        Method::create([
            'name' => 'Gestion des chéquiers',
            'macroprocess_id' => $macroprocess23->id
        ]);

        //macroprocess 24
        $macroprocess24 = Macroprocess::firstWhere('name', 'Gestion des normes et référentiels');
        Method::create([
            'name' => 'Formalisation/revue des référentiels',
            'macroprocess_id' => $macroprocess24->id
        ]);

        //macroprocess 25
        $macroprocess25 = Macroprocess::firstWhere('name', 'Gestion des opérations de caisse');
        Method::create([
            'name' => 'Gestion de l\'encaisse',
            'macroprocess_id' => $macroprocess25->id
        ]);
        Method::create([
            'name' => 'Gestion des retraits et versements',
            'macroprocess_id' => $macroprocess25->id
        ]);
        Method::create([
            'name' => 'Gestion des opérations de change',
            'macroprocess_id' => $macroprocess25->id
        ]);
        Method::create([
            'name' => 'Mouvements et rammassage de fonds',
            'macroprocess_id' => $macroprocess25->id
        ]);
        Method::create([
            'name' => 'Gestion des mises à disposition',
            'macroprocess_id' => $macroprocess25->id
        ]);
        Method::create([
            'name' => 'Gestion des transferts Western Union',
            'macroprocess_id' => $macroprocess25->id
        ]);
        Method::create([
            'name' => 'Gestion des placements',
            'macroprocess_id' => $macroprocess25->id
        ]);

        //macroprocess 26
        $macroprocess26 = Macroprocess::firstWhere('name', 'Gestion des opérations de marché');
        Method::create([
            'name' => 'Constitution de la réserve monétaire',
            'macroprocess_id' => $macroprocess26->id
        ]);
        Method::create([
            'name' => 'Gestion des opérations prêt/Emprunt',
            'macroprocess_id' => $macroprocess26->id
        ]);
        Method::create([
            'name' => 'Gestion des opérations de change',
            'macroprocess_id' => $macroprocess26->id
        ]);
        Method::create([
            'name' => 'Gestion des opérations sur pensions',
            'macroprocess_id' => $macroprocess26->id
        ]);

        //macroprocess 27
        $macroprocess27 = Macroprocess::firstWhere('name', 'Gestion des opérations internationales');
        Method::create([
            'name' => 'Gestion des garanties internationales',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des crédits documentaires',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des domiciliations',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des paiements de droits de douane',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des remises documentaires',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des transferts et des rapatriements',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des SWIFT',
            'macroprocess_id' => $macroprocess27->id
        ]);
        Method::create([
            'name' => 'Gestion des déclarations règlementaires',
            'macroprocess_id' => $macroprocess27->id
        ]);

        //macroprocess 28
        $macroprocess28 = Macroprocess::firstWhere('name', 'Gestion des opérations locales');
        Method::create([
            'name' => 'Gestion de la compensation',
            'macroprocess_id' => $macroprocess28->id
        ]);
        Method::create([
            'name' => 'Gestion des prélèvements',
            'macroprocess_id' => $macroprocess28->id
        ]);
        Method::create([
            'name' => 'Gestion des virements',
            'macroprocess_id' => $macroprocess28->id
        ]);

        //macroprocess 29
        $macroprocess29 = Macroprocess::firstWhere('name', 'Gestion des opérations sur le marché interbancaire');
        Method::create([
            'name' => 'Gestion des prêts et emprunts interbancaires',
            'macroprocess_id' => $macroprocess29->id
        ]);

        //macroprocess 30
        $macroprocess30 = Macroprocess::firstWhere('name', 'Gestion des opérations sur Titres et valeurs mobilières');
        Method::create([
            'name' => 'Gestion des opérations courantes sur titres',
            'macroprocess_id' => $macroprocess30->id
        ]);

        //macroprocess 31
        $macroprocess31 = Macroprocess::firstWhere('name', 'Gestion des prêts syndiqués');
        Method::create([
            'name' => 'Mise en place de prêts syndiqués',
            'macroprocess_id' => $macroprocess31->id
        ]);
        Method::create([
            'name' => 'Suivi des prêts syndiqués',
            'macroprocess_id' => $macroprocess31->id
        ]);

        //macroprocess 32
        $macroprocess32 = Macroprocess::firstWhere('name', 'Gestion des produits et services');
        Method::create([
            'name' => 'Connaissance des produits',
            'macroprocess_id' => $macroprocess32->id
        ]);
        Method::create([
            'name' => 'Placements, Epargnes & Produits de Bancassurance',
            'macroprocess_id' => $macroprocess32->id
        ]);

        //macroprocess 33
        $macroprocess33 = Macroprocess::firstWhere('name', 'Gestion des projets et de la veille juridique');
        Method::create([
            'name' => 'Etudes et projets juridiques',
            'macroprocess_id' => $macroprocess33->id
        ]);
        Method::create([
            'name' => 'Veille juridique',
            'macroprocess_id' => $macroprocess33->id
        ]);

        //macroprocess 34
        $macroprocess34 = Macroprocess::firstWhere('name', 'Gestion des réclamations');
        Method::create([
            'name' => 'Réception des réclamations',
            'macroprocess_id' => $macroprocess34->id
        ]);
        Method::create([
            'name' => 'Suvi des réclamations',
            'macroprocess_id' => $macroprocess34->id
        ]);
        Method::create([
            'name' => 'Traitement des réclamations',
            'macroprocess_id' => $macroprocess34->id
        ]);

        //macroprocess 35
        $macroprocess35 = Macroprocess::firstWhere('name', 'Gestion des relations et oeuvres sociales');
        Method::create([
            'name' => 'Gestion de la médecine du travail',
            'macroprocess_id' => $macroprocess35->id
        ]);
        Method::create([
            'name' => 'Mécénat, Œuvres sociales',
            'macroprocess_id' => $macroprocess35->id
        ]);
        Method::create([
            'name' => 'Préparation et tenue des comités sociaux (CE, CHSCT…)',
            'macroprocess_id' => $macroprocess35->id
        ]);
        Method::create([
            'name' => 'Gestion des assurances sociales',
            'macroprocess_id' => $macroprocess35->id
        ]);
        Method::create([
            'name' => 'Restauration',
            'macroprocess_id' => $macroprocess35->id
        ]);
        Method::create([
            'name' => 'Gestion des partenaires sociaux',
            'macroprocess_id' => $macroprocess35->id
        ]);
        Method::create([
            'name' => 'Gestion des contentieux sociaux',
            'macroprocess_id' => $macroprocess35->id
        ]);

        //macroprocess 36
        $macroprocess36 = Macroprocess::firstWhere('name', 'Gestion des reportings');
        Method::create([
            'name' => 'Gestion des reportings réglementaires (relatifs aux opérations bancaires)',
            'macroprocess_id' => $macroprocess36->id
        ]);
        Method::create([
            'name' => 'Gestion des reportings',
            'macroprocess_id' => $macroprocess36->id
        ]);

        //macroprocess 37
        $macroprocess37 = Macroprocess::firstWhere('name', 'Gestion des reportings financiers');
        Method::create([
            'name' => 'Reporting Réglementaire et relation avec la banque centrale',
            'macroprocess_id' => $macroprocess37->id
        ]);

        //macroprocess 38
        $macroprocess38 = Macroprocess::firstWhere('name', 'Gestion des services E-Banking');
        Method::create([
            'name' => 'Gestion de l\'adhésion aux services E-Banking',
            'macroprocess_id' => $macroprocess38->id
        ]);
        Method::create([
            'name' => 'Gestion de la résiliation des services E-Banking',
            'macroprocess_id' => $macroprocess38->id
        ]);
        Method::create([
            'name' => 'Gestion des incidents E-Banking',
            'macroprocess_id' => $macroprocess38->id
        ]);

        //macroprocess 39
        $macroprocess39 = Macroprocess::firstWhere('name', 'Gestion du marketing');
        Method::create([
            'name' => 'Community Management',
            'macroprocess_id' => $macroprocess39->id
        ]);
        Method::create([
            'name' => 'Conception, mise en place et lancement des nouveaux produits',
            'macroprocess_id' => $macroprocess39->id
        ]);
        Method::create([
            'name' => 'Gestion de la tarification',
            'macroprocess_id' => $macroprocess39->id
        ]);
        Method::create([
            'name' => 'Gestion des goodies et cadeaux',
            'macroprocess_id' => $macroprocess39->id
        ]);
        Method::create([
            'name' => 'Marketing stratégique (en cours de mise en place)',
            'macroprocess_id' => $macroprocess39->id
        ]);
        Method::create([
            'name' => 'MOE des sites WEB',
            'macroprocess_id' => $macroprocess39->id
        ]);

        //macroprocess 40
        $macroprocess40 = Macroprocess::firstWhere('name', 'Gestion du patrimoine');
        Method::create([
            'name' => 'Gestion du patrimoine foncier',
            'macroprocess_id' => $macroprocess40->id
        ]);
        Method::create([
            'name' => 'Gestion du patrimoine locatif',
            'macroprocess_id' => $macroprocess40->id
        ]);
        Method::create([
            'name' => 'Gestion des assurances',
            'macroprocess_id' => $macroprocess40->id
        ]);

        //macroprocess 41
        $macroprocess41 = Macroprocess::firstWhere('name', 'Gestion du personnel et de la paie');
        Method::create([
            'name' => 'Retraites, prevoyance, mutuelles',
            'macroprocess_id' => $macroprocess41->id
        ]);
        Method::create([
            'name' => 'Gestion administrative du personnel',
            'macroprocess_id' => $macroprocess41->id
        ]);
        Method::create([
            'name' => 'Gestion de la paie et de la rémunération',
            'macroprocess_id' => $macroprocess41->id
        ]);

        //macroprocess 42
        $macroprocess42 = Macroprocess::firstWhere('name', 'Gestion du recouvrement');
        Method::create([
            'name' => 'Alimentation des prestataires',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Cadrage localisation (demeure et patrimoine)',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Détection/pré-recouvrement',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Gestion des immobilisations hors exploitation',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Radiation et write off',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Recouvrement amiable',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Recouvrement contentieux',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Recouvrement des créances difficiles',
            'macroprocess_id' => $macroprocess42->id
        ]);
        Method::create([
            'name' => 'Restructuration des créances CDL',
            'macroprocess_id' => $macroprocess42->id
        ]);

        //macroprocess 43
        $macroprocess43 = Macroprocess::firstWhere('name', 'Logistique');
        Method::create([
            'name' => 'Gestion de la flotte',
            'macroprocess_id' => $macroprocess43->id
        ]);
        Method::create([
            'name' => 'Gestion des archives',
            'macroprocess_id' => $macroprocess43->id
        ]);
        Method::create([
            'name' => 'Gestion du mobilier',
            'macroprocess_id' => $macroprocess43->id
        ]);
        Method::create([
            'name' => 'Gestion de l\'économat',
            'macroprocess_id' => $macroprocess43->id
        ]);

        //macroprocess 44
        $macroprocess44 = Macroprocess::firstWhere('name', 'Moyens généraux');
        Method::create([
            'name' => 'Gestion de la sécurité des sites',
            'macroprocess_id' => $macroprocess44->id
        ]);
        Method::create([
            'name' => 'Gestion du courrier',
            'macroprocess_id' => $macroprocess44->id
        ]);

        //macroprocess 45
        $macroprocess45 = Macroprocess::firstWhere('name', 'Stratégie et pilotage SI');
        Method::create([
            'name' => 'Pilotage et planification SI',
            'macroprocess_id' => $macroprocess45->id
        ]);

        //macroprocess 46
        $macroprocess46 = Macroprocess::firstWhere('name', 'Suivi des risques');
        Method::create([
            'name' => 'Suivi des risques ALM (liquidité, taux)',
            'macroprocess_id' => $macroprocess46->id
        ]);
        Method::create([
            'name' => 'Suivi des risques de crédit et de contrepartie',
            'macroprocess_id' => $macroprocess46->id
        ]);
        Method::create([
            'name' => 'Suivi des risques de marché',
            'macroprocess_id' => $macroprocess46->id
        ]);
        Method::create([
            'name' => 'Suivi des risques opérationnels',
            'macroprocess_id' => $macroprocess46->id
        ]);

        //macroprocess47
        $macroprocess47 = Macroprocess::firstwhere('name', 'Développement et pilotage de projets');
        Method::create([
            'name' => 'Gestion de projet',
            'macroprocess_id' => $macroprocess47->id
        ]);
    }
}
