<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UtilisateurModel extends Model
{
    // Récupérer les candidatures d'un utilisateur
    function GetCandidature($id) {
        $candidature = DB::table('annonce')
            ->join('postuleur', 'annonce.id', '=', 'postuleur.idAnnonce')
            ->join('typecontrat', 'typecontrat.id', '=', 'annonce.typeContratId')
            ->join('status', 'status.id', '=', 'postuleur.idStatus')
            ->join('entreprise', 'annonce.entrepriseId', '=', 'entreprise.id')
            ->select(
                'entreprise.id as idEntreprise',
                'postuleur.idAnnonce',
                'entreprise.nomEntreprise', 
                'annonce.titre', 
                'typecontrat.libelle', 
                'status.libelleStatus', 
                'status.couleur', 
            )
            ->where('postuleur.idUser', '=', $id)
            ->get();
        
        return $candidature;
    }

    // Récupérer les détails d'une candidature spécifique
    function GetTheCandidature($id, $idCandidature) {
        $candidature = DB::table('annonce')
            ->join('postuleur', 'annonce.id', '=', 'postuleur.idAnnonce')
            ->join('typecontrat', 'typecontrat.id', '=', 'annonce.typeContratId')
            ->join('status', 'status.id', '=', 'postuleur.idStatus')
            ->join('entreprise', 'annonce.entrepriseId', '=', 'entreprise.id')
            ->select(
                'postuleur.idAnnonce',
                'entreprise.nomEntreprise', 
                'annonce.titre', 
                'annonce.description', 
                'typecontrat.libelle', 
                'status.libelleStatus', 
                'status.couleur', 
                'postuleur.cv', 
                'postuleur.lettreMotivation', 
                'postuleur.datePostulage'
            )
            ->where('postuleur.idUser', '=', $id)
            ->where('postuleur.idAnnonce', '=', $idCandidature)
            ->get();

        return $candidature;
    }

    // Permet à un utilisateur de postuler à une annonce
    function Postuler($idUser, $idAnnonce, $cv, $lettreMotivation) {
        $postuler = DB::table('postuleur')
            ->insert([
                'idUser' => $idUser,
                'idAnnonce' => $idAnnonce,
                'cv' => $cv,
                'lettreMotivation' => $lettreMotivation,
                'idStatus' => 1,
                'datePostulage' => now()
            ]);
    }

    // Permet à un utilisateur non connecté de postuler à une annonce
    function PostulerNonConnecter($idAnnonce, $cv, $lettreMotivation, $firstName, $lastName, $email) {
        $postulerNonConnecter = DB::table('postuleur')
            ->insert([
                'idAnnonce' => $idAnnonce,
                'cv' => $cv,
                'lettreMotivation' => $lettreMotivation,
                'idStatus' => 1,
                'datePostulage' => now(),
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email
            ]);
    }
}
