<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DefaultModel;
use Illuminate\Http\Request;
use App\Models\RecruteurModel;
use App\Models\UtilisateurModel;

class UtilisateurApiController extends Controller
{
    private $defaultModel;
    private $utilisateurModel;
    private $recruteurModel;

    public function __construct()
    {
        // Initialisation des modèles 
        $this->defaultModel = new DefaultModel;
        $this->utilisateurModel = new UtilisateurModel;
        $this->recruteurModel = new RecruteurModel;
    }

    // Obtenir une liste de tous les utilisateurs (peut nécessiter une autorisation)
    public function index() {
        $listUsers = User::all();
        return response()->json($listUsers);
    }

    // Obtenir des informations sur l'utilisateur, y compris ses détails de profil
    public function IndexUser($id) {
        return response()->json(['user' => $this->defaultModel->GetUser($id), 'id' => $id, 'typeContrat' => $this->defaultModel->TypeContrat(), 'results' => null]);
    }

    // Obtenir des informations sur le profil de l'utilisateur
    public function ProfileUser($id) {
        return response()->json(['user' => $this->defaultModel->GetUser($id), 'id' => $id]);
    }

    // Obtenir les candidatures de l'utilisateur
    public function CandidatureUser($id) {
        return response()->json(['user' => $this->defaultModel->GetUser($id), 'id' => $id, 'candidatures' => $this->utilisateurModel->GetCandidature($id)]);    
    }

    // Obtenir des détails sur une candidature spécifique de l'utilisateur
    public function TheCandidatureUser($id, $idCandidature) {
        return response()->json(['user' => $this->defaultModel->GetUser($id), 'id' => $id, 'candidature' => $this->utilisateurModel->GetTheCandidature($id, $idCandidature)]);
    }

    // Obtenir des informations sur une annonce, y compris les candidatures associées
    public function AnnonceInfo(Request $request, $idAnnonce) {
        // Vérifie si l'utilisateur est connecté et renvoie des informations en conséquence
        if ($request->input('id') != null) {
            return response()->json(['annonce' => $this->defaultModel->GetAnnonce($idAnnonce), 'candidatures' => $this->recruteurModel->GetCandidatures($idAnnonce), 'id' => $request->input('id'), 'countPostuler' => $this->defaultModel->VerifyPostule($idAnnonce, $request->input('id'))]);
        } else {
            return response()->json(['annonce' => $this->defaultModel->GetAnnonce($idAnnonce), 'candidatures' => null, 'id' => null, 'countPostuler' => null]);
        }
    }

    // Gérer une demande de postulation
    public function Postuler(Request $request) {
        try {
            $this->utilisateurModel->Postuler($request->input('idUser'), $request->input('idAnnonce'), $request->input('inputCv'), $request->input('inputLettreMotivation'));
            return response()->json(['success' => true]);   
        }
        catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    // Gérer une demande de postulation pour un utilisateur non connecté
    public function PostulerNonConnecter(Request $request) {
        try {
            $this->utilisateurModel->PostulerNonConnecter($request->input('idAnnonce'), $request->input('inputCv'), $request->input('inputLettreMotivation'), $request->input('firstName'), $request->input('lastName'), $request->input('email'));
            return response()->json(['status' => true]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    // Obtenir des informations sur une entreprise, y compris les détails des employés, les offres d'emploi, les réseaux sociaux, les domaines, etc.
    public function EntrepriseInfo($idEntreprise) {
        $id = null;
        if(session()->get('user')) {
            $id = session()->get('user')->id;
        }
    
        return response()->json(['entreprise' => $this->defaultModel->GetEntreprise($idEntreprise), 'salaries' => $this->defaultModel->GetSalaries($idEntreprise), 'id' => $id, 'nbOffres' => $this->defaultModel->GetNbOffres($idEntreprise), 'reseaux' => $this->defaultModel->GetReseauxEntreprise($idEntreprise), 'domaines' => $this->defaultModel->GetDomainesEntreprise($idEntreprise)]);
    }
}
