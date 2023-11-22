<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class AdministrateurModel extends Model
{
    // Supprimer un utilisateur
    function DeleteUser($idUser) {
        $postuleur = DB::table('postuleur')
        ->where('idUser', '=', $idUser)
        ->delete();

        $annonce = DB::table('annonce')
        ->where('idUser', '=', $idUser)
        ->update(['idUser' => NULL]);

        $user = DB::table('user')
        ->where('user.id', '=', $idUser)
        ->delete();

        return [$postuleur, $annonce, $user];
    }

    // Supprimer une entreprise avec ses données associées
    function DeleteEntreprise($idEntreprise) {
        $reseauxSociaux = DB::table('reseauxSociaux')
        ->where('idEntreprise', '=', $idEntreprise)
        ->delete();

        $domaine = DB::table('domaineentreprise')
        ->where('idEntreprise', '=', $idEntreprise)
        ->delete();

        $user = DB::table('user')
        ->where('idEntreprise', '=', $idEntreprise)
        ->update([
            'idEntreprise' => NULL,
        ]);

        DB::table('postuleur')
        ->whereIn('idAnnonce', function ($query) use ($idEntreprise) {
            $query->select('id')
                ->from('annonce')
                ->where('entrepriseId', '=', $idEntreprise);
        })
        ->delete();

        $annonce = DB::table('annonce')
        ->where('entrepriseId', '=', $idEntreprise)
        ->delete();

        $entreprise = DB::table('entreprise')
        ->where('entreprise.id', '=', $idEntreprise)
        ->delete();

        return [$reseauxSociaux, $domaine, $annonce, $entreprise];
    }

    // Mettre à jour les informations d'une entreprise
    function UpdateEntreprise($idEntreprise, $name, $description, $siegeSocial, $nombreSalaries) {
        $updateData = [
            'entreprise.nomEntreprise' => $name,
            'entreprise.descriptionEntreprise' => $description,
            'entreprise.siegeSocial' => $siegeSocial,
            'entreprise.nbSalarie' => $nombreSalaries,
        ];
        
        $updateEntreprise = DB::table('entreprise')
            ->where('entreprise.id', '=', $idEntreprise)
            ->update($updateData);
            
        return $updateEntreprise;
    }

    // Mettre à jour les informations d'une annonce
    function UpdateAnnonce($idAnnonce, $titre, $description, $typeContratId, $salaireMinAn, $salaireMaxAn, $duree, $adresse, $ville, $codePostal) {
        $updateData = [
            'titre' => $titre,
            'description' => $description,
            'typeContratId' => $typeContratId,
            'salaireMinAn' => $salaireMinAn,
            'salaireMaxAn' => $salaireMaxAn,
            'duree' => $duree,
            'adresse' => $adresse,
            'ville' => $ville,
            'codePostal' => $codePostal
        ];
    
        $updateAnnonce = DB::table('annonce')
            ->where('id', $idAnnonce)
            ->update($updateData);
    
        return $updateAnnonce;
    }

    // Récupérer les rôles des utilisateurs
    function GetRole() {
        $role = DB::table('role')
        ->get();

        return $role;
    }

    // Créer un nouvel utilisateur
    function CreateUser($identifiant, $password, $roleId, $email, $firstName, $lastName, $adresse, $codePostal, $ville, $telephone, $isActive, $pays) {
        $hashedPassword = Hash::make($password, [
            'rounds' => 12,
        ]);
        if($isActive == "null") {
            $isActive = 0;
        } 
        $user = DB::table('user')
        ->insert([
            'identifiant' => $identifiant,
            'password' => $hashedPassword,
            'date_creation' => now(),
            'remember_token' => null,
            'roleId' => $roleId,
            'email' => $email,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'adresse' => $adresse,
            'codePostal' => $codePostal,
            'ville' => $ville,
            'telephone' => $telephone,
            'isActive' => $isActive,
            'pays' => $pays,
            'idEntreprise' => null,
        ]);

        return $user;
    }
}
