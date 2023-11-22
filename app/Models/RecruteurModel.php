<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecruteurModel extends Model
{
    use HasFactory;

    // Récupérer toutes les annonces
    public function GetAnnonces() {
        $annonces = DB::table('annonce')
            ->select('annonce.id', 'annonce.titre', 'annonce.description', 'entreprise.nomEntreprise', 'entreprise.id as idEntreprise')
            ->join('entreprise', 'entreprise.id', '=', 'annonce.entrepriseId')
            ->orderBy('annonce.creationDate')
            ->get();
        return $annonces;
    }
    
    // Récupérer les annonces par entreprise pour un utilisateur donné
    public function GetAnnoncesByEntreprise($idUser) {
        $annonces = DB::table('entreprise')
            ->select('annonce.id', 'annonce.titre', 'annonce.description', 'annonce.creationDate', 'entreprise.nomEntreprise', 'entreprise.id as idEntreprise')
            ->join('annonce', 'entreprise.id', '=', 'annonce.entrepriseId')
            ->join('user', 'user.idEntreprise', '=', 'entreprise.id')
            ->where('annonce.entrepriseId', '=', function ($query) use ($idUser) {
                $query->select('idEntreprise')
                    ->from('user')
                    ->where('id', '=', $idUser);
            })
            ->orderBy('annonce.creationDate')
            ->distinct()
            ->get();
        return $annonces;
    }

    // Récupérer les candidatures pour une annonce donnée
    public function GetCandidatures($idAnnonce) {
        $candidatures = DB::table('postuleur')
            ->select('postuleur.idUser', 'postuleur.postuleurId', 'postuleur.idAnnonce', 'postuleur.cv', 'postuleur.lettreMotivation', 'postuleur.datePostulage', 'status.libelleStatus', 'status.couleur', 'user.firstName as prenomUser', 'user.lastName as nomUser', 'postuleur.firstName', 'postuleur.lastName', 'postuleur.email')
            ->join('status', 'status.id', '=', 'postuleur.idStatus')
            ->leftjoin('user', 'user.id', '=', 'postuleur.idUser')
            ->where('postuleur.idAnnonce', '=', $idAnnonce)
            ->where('postuleur.idStatus', '=', '1')
            ->orderBy('postuleur.datePostulage')
            ->get();

        return $candidatures;
    }

    // Récupérer une candidature spécifique
    public function GetCandidature($postuleurId) {
        $candidature = DB::table('postuleur')
            ->select('postuleur.idUser', 'postuleur.postuleurId' , 'postuleur.idAnnonce', 'postuleur.cv', 'postuleur.lettreMotivation', 'postuleur.datePostulage', 'user.firstName as prenomUser', 'user.lastName as nomUser', 'annonce.titre', 'postuleur.firstName', 'postuleur.lastName', 'postuleur.email')
            ->leftjoin('user', 'user.id', '=', 'postuleur.idUser')
            ->join('annonce', 'annonce.id', '=', 'postuleur.idAnnonce')
            ->where('postuleur.postuleurId', '=', $postuleurId)
            ->first();
        return $candidature;
    }

    // Récupérer les statuts des candidatures
    public function GetReponse() {
        $reponse = DB::table('status')
            ->select('id', 'libelleStatus', 'couleur')
            ->get();
        return $reponse;
    }

    // Mettre à jour le statut d'une candidature
    public function CandidatureResponse($idUser, $idAnnonce, $idStatus) {
        $response = DB::table('postuleur')
            ->where('idUser', '=', $idUser)
            ->where('idAnnonce', '=', $idAnnonce)
            ->update(['idStatus' => $idStatus]);
        return $response;
    }

    // Créer une nouvelle annonce
    public function CreateAnnonce($titre, $description, $typeContrat, $salaireMin, $salaireMax, $duree, $adresse, $ville, $codePostal, $dateDebut, $dateFin, $idUser) {
        $entrepriseId = DB::table('user')->select('idEntreprise')->where('id', '=', $idUser)->first();
        $annonce = DB::table('annonce')->insert([
            'titre' => $titre,
            'description' => $description,
            'entrepriseId' => $entrepriseId->idEntreprise,
            'typeContratId' => $typeContrat,
            'salaireMinAn' => $salaireMin,
            'salaireMaxAn' => $salaireMax,
            'creationDate' => now(),
            'duree' => $duree,
            'adresse' => $adresse,
            'ville' => $ville,
            'codePostal' => $codePostal,
            'idUser' => $idUser,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin
        ]);

        return $annonce;
    }

    // Supprimer une annonce et les candidatures associées
    function DeleteAnnonce($idAnnonce) {
        $postuleur = DB::table('postuleur')
            ->where('idAnnonce', '=', $idAnnonce)
            ->delete();

        $annonce = DB::table('annonce')
            ->where('id', '=', $idAnnonce)
            ->delete();

        return [$postuleur, $annonce];
    }

    // Créer une nouvelle entreprise et associer à un utilisateur
    public function CreateCorporate($idUser, $titre, $description, $siegeSocial, $nbSalarie) {
        $addCorporate = DB::table('entreprise')->insert([
            'nomEntreprise' => $titre,
            'descriptionEntreprise' => $description,
            'siegeSocial' => $siegeSocial,
            'nbSalarie' => $nbSalarie,
            'date_creation' => now(),
        ]);

        $addCorporateUser = DB::table('user')->where('user.id', '=', $idUser)
            ->update([
                'user.idEntreprise' => DB::table('entreprise')->select('id')->where('nomEntreprise', '=', $titre)->first()->id,
                'user.isActive' => '1',
            ]);

        return [$addCorporate, $addCorporateUser];
    }

    // Supprimer l'association de l'utilisateur à une entreprise
    public function RemoveCorporate($id) {
        $removeCorporateUser = DB::table('user')->where('user.id', '=', $id)
            ->update(['idEntreprise' => null, 'isActive' => '0']);
        
        return $removeCorporateUser;
    }
}
