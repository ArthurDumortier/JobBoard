<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InscriptionModel extends Model
{
    use HasFactory;

    // Définir la table associée à ce modèle
    protected $table = 'user';

    // Méthode pour ajouter un utilisateur à la base de données
    public function AddUser($Identifiant, $Password, $Role, $FirstName, $LastName, $Email, $Address, $Ville, $CodePostal, $NumTel, $Pays){
        // Hacher le mot de passe avec des options de hachage
        $hashedPassword = Hash::make($Password, [
            'rounds' => 12,
        ]);

        $isActive = true;

        // Vérifier le rôle de l'utilisateur
        if($Role == 3){
            $isActive = false;
        }

        // Insérer les données de l'utilisateur dans la table "User"
        $user = DB::insert('INSERT INTO user (identifiant, password, date_creation, roleId, email, firstName, lastName, adresse, codepostal, ville, telephone, isActive, pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $Identifiant, $hashedPassword, now(), $Role, $Email, $FirstName, $LastName, $Address, $CodePostal, $Ville, $NumTel, $isActive, $Pays
        ]);

        // Retourner le résultat de l'insertion
        return $user;
    }
}
