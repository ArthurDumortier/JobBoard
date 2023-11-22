<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseFakeData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        // Table: typecontrat
        \DB::table('typecontrat')->insert([
            'libelle' => 'CDD',
        ]);

        \DB::table('typecontrat')->insert([
            'libelle' => 'CDI',
        ]);

        \DB::table('typecontrat')->insert([
            'libelle' => 'Stage',
        ]);

        \DB::table('typecontrat')->insert([
            'libelle' => 'Alternance',
        ]);

        // Table: status
        \DB::table('status')->insert([
            'libelleStatus' => 'En attente',
            'couleur' => '#DCDCDC',
        ]);

        \DB::table('status')->insert([
            'libelleStatus' => 'Accepté',
            'couleur' => '#1EFE08',
        ]);

        \DB::table('status')->insert([
            'libelleStatus' => 'Refusé',
            'couleur' => '#FE3408',
        ]);

        // Table: role
        \DB::table('role')->insert([
            'libelle' => 'Administrateur',
        ]);

        \DB::table('role')->insert([
            'libelle' => 'Utilisateur',
        ]);

        \DB::table('role')->insert([
            'libelle' => 'Recruteur',
        ]);

        // Table: reseaux
        \DB::table('reseaux')->insert([
            'libelle' => 'LinkedIn',
        ]);

        \DB::table('reseaux')->insert([
            'libelle' => 'Twitter',
        ]);

        \DB::table('reseaux')->insert([
            'libelle' => 'Facebook',
        ]);

        \DB::table('reseaux')->insert([
            'libelle' => 'Instagram',
        ]);

        // Table: domaine

        \DB::table('domaine')->insert([
            'libelle' => 'Informatique',
        ]);

        \DB::table('domaine')->insert([
            'libelle' => 'Agriculture',
        ]);

        \DB::table('domaine')->insert([
            'libelle' => 'Industrie',
        ]);

        \DB::table('domaine')->insert([
            'libelle' => 'BTP',
        ]);

        \DB::table('domaine')->insert([
            'libelle' => 'Commerce',
        ]);

        \DB::table('domaine')->insert([
            'libelle' => 'Santé',
        ]);

        // Table: entreprise
        for ($i = 0; $i < 10; $i++) {
            \DB::table('entreprise')->insert([
                'nomEntreprise' => $faker->company,
                'descriptionEntreprise' => $faker->text,
                'siegeSocial' => $faker->city,
                'nbSalarie' => $faker->numberBetween(1, 1000),
                'date_creation' => now(),
            ]);
        }

        // Table : reseauxsociaux
        $reseauxSociaux = [];

        for ($i = 0; $i < 10; $i++) {
            $idEntreprise = $faker->numberBetween(1, 10);
            $idReseaux = $faker->numberBetween(1, 4);

            // Vérifier si la combinaison existe déjà
            $existeDeja = in_array([$idEntreprise, $idReseaux], $reseauxSociaux);

            // Si elle existe déjà, réduire $i pour refaire l'itération actuelle
            if ($existeDeja) {
                $i--;
                continue;
            }

            $reseauxSociaux[] = [$idEntreprise, $idReseaux];

            \DB::table('reseauxsociaux')->insert([
                'idEntreprise' => $idEntreprise,
                'idReseaux' => $idReseaux,
                'libelle' => $faker->url,
            ]);
        }

        // Table: domaineentreprise

        $domainesEntreprises = [];

        for ($i = 0; $i < 10; $i++) {
            $idEntreprise = $faker->numberBetween(1, 10);
            $idDomaine = $faker->numberBetween(1, 6);

            // Vérifier si la combinaison existe déjà
            $existeDeja = in_array([$idEntreprise, $idDomaine], $domainesEntreprises);

            // Si elle existe déjà, réduire $i pour refaire l'itération actuelle
            if ($existeDeja) {
                $i--;
                continue;
            }

            $domainesEntreprises[] = [$idEntreprise, $idDomaine];

            \DB::table('domaineentreprise')->insert([
                'idEntreprise' => $idEntreprise,
                'idDomaine' => $idDomaine,
            ]);
        }

        // Table: user

        $recruteurActiveCree = false;

        for ($i = 0; $i < 10; $i++) {
            $password = Hash::make('Azerty@123');
            $roleId = $faker->numberBetween(1, 3);

            // Si l'utilisateur créé est un recruteur et n'a pas encore été marqué comme actif
            if ($roleId === 3 && !$recruteurActiveCree) {
                $isActive = 1;
                $recruteurActiveCree = true; // Marquer un recruteur comme actif
                $idEntreprise = $faker->numberBetween(1, 10);
            } else {
                $isActive = $faker->numberBetween(0, 1);
                $idEntreprise = ($roleId === 3) ? $faker->numberBetween(1, 10) : null;
            }

            \DB::table('user')->insert([
                'identifiant' => $faker->userName,
                'password' => $password,
                'date_creation' => now(),
                'remember_token' => null,
                'roleId' => $roleId,
                'email' => $faker->email,
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'adresse' => $faker->address,
                'codePostal' => '69000', // Lyon par défaut pour tous les utilisateurs
                'ville' => $faker->city,
                'telephone' => $faker->phoneNumber,
                'isActive' => $isActive,
                'pays' => 'France',
                'idEntreprise' => $idEntreprise,
            ]);
        }


         // Table: annonce
        for ($i = 0; $i < 10; $i++) {
            // Sélectionner un utilisateur avec le rôle "Recruteur" (roleId = 3) et ayant isActive à 1
            $userRecruteur = \DB::table('user')->where('roleId', 3)->where('isActive', 1)->inRandomOrder()->first();
        
            if ($userRecruteur) {
                // Utiliser l'ID de l'utilisateur pour obtenir l'ID de l'entreprise
                $entrepriseId = $userRecruteur->idEntreprise;
        
                // Créer l'annonce en utilisant les informations récupérées
                \DB::table('annonce')->insert([
                    'titre' => $faker->jobTitle,
                    'description' => $faker->text,
                    'entrepriseId' => $entrepriseId,
                    'typeContratId' => $faker->numberBetween(1, 4),
                    'salaireMinAn' => $faker->numberBetween(10000, 50000),
                    'salaireMaxAn' => $faker->numberBetween(50000, 100000),
                    'creationDate' => now(), 
                    'duree' => $faker->numberBetween(1, 12), // 1 = 1 mois, 12 = 1 an
                    'adresse' => $faker->address,
                    'ville' => $faker->city,
                    'codePostal' => '69000', // Lyon par défaut pour toutes les annonces
                    'idUser' => $userRecruteur->id,
                    'dateDebut' => $faker->dateTimeBetween(now(), '+1 month'),
                    'dateFin' =>  $faker->dateTimeBetween(now(), '+5 month'),
                ]);
            }
        }

        // Table: postuleur

        $postuleurs = [];

        for ($i = 0; $i < 10; $i++) {
            $userId = \DB::table('user')->where('roleId', 2)->inRandomOrder()->first()->id;
            $annonceId = $faker->numberBetween(1, 10);

            // Vérifier si la combinaison existe déjà
            $existeDeja = in_array([$userId, $annonceId], $postuleurs);

            // Si elle existe déjà, réduire $i pour refaire l'itération actuelle
            if ($existeDeja) {
                $i--;
                continue;
            }

            $postuleurs[] = [$userId, $annonceId];

            \DB::table('postuleur')->insert([
                'idAnnonce' => $annonceId,
                'idUser' => $userId,
                'cv' => $faker->url,
                'lettreMotivation' => $faker->url,
                'idStatus' => 1, // 1 = En attente, 2 = Accepté, 3 = Refusé 
                'datePostulage' => now(),
            ]);
        }
    }
}
