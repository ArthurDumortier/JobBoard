<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DefaultModel extends Model
{
    use HasFactory;
    protected $table = 'user';

    // Récupérer les informations d'un utilisateur par son ID
    function GetUser($id) {
        $user = DB::table('user')
        ->select('identifiant', 'user.date_creation', 'email', 'firstName', 'lastName', 'adresse', 'codepostal', 'ville', 'pays', 'telephone', 'isActive', 'entreprise.nomEntreprise', 'entreprise.id as idEntreprise')
        ->leftJoin('entreprise', 'entreprise.id', '=', 'user.idEntreprise')
        ->where('user.id', $id)
        ->get();
        return $user;
    }

    // Récupérer les types de contrat
    function TypeContrat() {
        $typeContrat = DB::table('typecontrat')
        ->select('id', 'libelle')
        ->get();
        return $typeContrat;
    }

    // Récupérer les domaines
    function GetDomaine() {
        $domaine = DB::table('domaine')
        ->select('id', 'libelle')
        ->get();
        return $domaine;
    }

    // Récupérer des annonces avec des critères de recherche
    function GetAnnonces($recherche, $ville, $contrat) {
        $annonces = DB::table('annonce')
        ->join('entreprise', 'entreprise.id', '=', 'annonce.entrepriseId')
        ->join('typecontrat', 'typecontrat.id', '=', 'annonce.typeContratId')
        ->select('annonce.id', 'entreprise.nomEntreprise', 'entreprise.id as idEntreprise', 'annonce.titre', 'annonce.description', 'typecontrat.libelle', 'annonce.creationDate', 'annonce.ville')
        ->where('annonce.titre', 'like', '%'.$recherche.'%')
        ->where('annonce.ville', 'like', '%'.$ville.'%')
        ->where('annonce.typeContratId', 'like', '%'.$contrat.'%')
        ->get();
        return $annonces;
    }

    // Récupérer le nombre d'annonces
    function GetNbAnnonces() {
        $nbAnnonces = DB::table('annonce')->count();
        return $nbAnnonces;
    }

    // Récupérer les détails d'une annonce
    function GetAnnonce($idAnnonce) {
        $annonce = DB::table('annonce')
        ->select(
            'entreprise.nomEntreprise',
            'entreprise.nbSalarie',
            'annonce.id',
            'annonce.entrepriseId',
            'annonce.titre',
            'annonce.adresse',
            'annonce.codePostal',
            'annonce.description',
            'annonce.duree',
            'annonce.salaireMinAn',
            'annonce.salaireMaxAn',
            'annonce.ville',
            'annonce.creationDate',
            'annonce.dateDebut',
            'annonce.dateFin',
            'typecontrat.libelle',
            'user.email',
            'user.firstName',
            'user.lastName',
            'user.telephone'
        )
        ->join('entreprise', 'entreprise.id', '=', 'annonce.entrepriseId')
        ->join('typecontrat', 'typecontrat.id', '=', 'annonce.typeContratId')
        ->join('user', 'user.id', '=', 'annonce.idUser')
        ->where('annonce.id', $idAnnonce)
        ->first();

        return $annonce;
    }

    // Vérifier si un utilisateur a déjà postulé à une annonce
    function VerifyPostule($idAnnonce, $idUser) {
        $countPostule = DB::table('postuleur')
        ->where('idAnnonce', $idAnnonce)
        ->where('idUser', $idUser)
        ->count();
        return $countPostule;
    }

    // Récupérer le nombre d'offres d'une entreprise
    function GetNbOffres($idEntreprise) {
        $nbOffres = DB::table('annonce')
        ->where('annonce.entrepriseId', $idEntreprise)
        ->count();
        return $nbOffres;
    }

    // Récupérer les informations d'une entreprise
    function GetEntreprise($idEntreprise) {
        $entreprise = DB::table('entreprise')
        ->select('entreprise.id', 'entreprise.nomEntreprise', 'entreprise.descriptionEntreprise', 'entreprise.nbSalarie', 'entreprise.siegeSocial')
        ->where('entreprise.id', $idEntreprise)
        ->first();
        return $entreprise;
    }

    // Récupérer les domaines d'une entreprise
    function GetDomainesEntreprise($idEntreprise) {
        $domaine = DB::table('entreprise')
        ->select('domaine.libelle')
        ->join('domaineentreprise', 'entreprise.id', '=', 'domaineentreprise.idEntreprise')
        ->join('domaine', 'domaine.id', '=', 'domaineentreprise.idDomaine')
        ->where('domaineentreprise.idEntreprise', '=', $idEntreprise)
        ->get();

        return $domaine;
    }

    // Récupérer les réseaux sociaux d'une entreprise
    function GetReseauxEntreprise($idEntreprise) {
        $reseaux = DB::table('reseauxSociaux')
        ->join('entreprise', 'entreprise.id', '=', 'reseauxsociaux.idEntreprise')
        ->join('reseaux', 'reseaux.id', '=', 'reseauxsociaux.idReseaux')
        ->where('reseauxsociaux.idEntreprise', '=', $idEntreprise)
        ->select('reseauxsociaux.libelle as libelleSociaux', 'reseaux.libelle as libelleReseaux')
        ->get();

        return $reseaux;
    }

    // Récupérer les salariés d'une entreprise
    function GetSalaries($idEntreprise) {
        $salaries = DB::table('entreprise')
        ->join('user', 'entreprise.id', '=', 'user.idEntreprise')
        ->where('entreprise.id', '=', $idEntreprise)
        ->select('user.firstName', 'user.lastName', 'user.email', 'user.telephone', 'user.isActive')
        ->get();

        return $salaries;
    }
    
    // Rechercher des entreprises par nom
    function SearchCorporate($recherche) {
        $corporates = DB::table('entreprise')
        ->select('entreprise.id', 'entreprise.nomEntreprise')
        ->where('entreprise.nomEntreprise', 'like', '%'.$recherche.'%')
        ->get();

        return $corporates;
    }

    // Joindre une entreprise en tant qu'utilisateur
    function JoinCorporate($idEntreprise, $idUser) {
        $joinCorporate = DB::table('user')
        ->where('user.id', '=', $idUser)
        ->update(['user.idEntreprise' => $idEntreprise]);

        return $joinCorporate;
    }

    // Mettre à jour les informations d'un utilisateur
    function UpdateUser($idUser, $identifiant, $email, $firstName, $lastName, $adresse, $ville, $tel) {
        $updateData = [
            'user.identifiant' => $identifiant,
            'user.email' => $email,
            'user.firstName' => $firstName,
            'user.lastName' => $lastName,
            'user.adresse' => $adresse,
            'user.ville' => $ville,
            'user.telephone' => $tel,
        ];
        
        $updateUser = DB::table('user')
            ->where('user.id', '=', $idUser)
            ->update($updateData);
            
        return $updateUser;
    }
}
