<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefaultModel;
use App\Models\RecruteurModel;

class RecruteurApiController extends Controller
{
    private $defaultModel;
    private $recruteurModel;

    public function __construct()
    {
        // Initialisation des modèles à l'aide d'un constructeur
        $this->defaultModel = new DefaultModel;
        $this->recruteurModel = new RecruteurModel;
    }

    public function indexRecruteur($id)
    {
        // Récupère les informations sur le recruteur et les annonces associées à son entreprise
        $user = $this->defaultModel->getUser($id);
        $annonces = $this->recruteurModel->GetAnnoncesByEntreprise($id);

        return response()->json([
            'user' => $user,
            'id' => $id,
            'annonces' => $annonces,
        ]);
    }

    public function profileRecruteur($id)
    {
        // Récupère les informations sur le profil du recruteur
        $user = $this->defaultModel->getUser($id);

        return response()->json([
            'user' => $user,
            'id' => $id,
        ]);
    }

     public function CandidatureInfo($postuleurId)
    {
        // Récupère des informations sur les candidatures
        $candidature = $this->recruteurModel->GetCandidature($postuleurId);
        $reponses = $this->recruteurModel->getReponse();

        return response()->json([
            'candidature' => $candidature,
            'reponses' => $reponses,
        ]);
    }

    public function CountPostuler($idAnnonce, $idUser) {
        // Compte le nombre de candidats ayant postulé à une annonce
        $countPostuler = $this->defaultModel->VerifyPostule($idAnnonce, $idUser);
        return response()->json(['countPostuler' => $countPostuler]);
    }

    public function CandidatureResponse(Request $request)
    {
        // Gère la réponse à une candidature (acceptée ou refusée ou en attente)
        try {
            $this->recruteurModel->CandidatureResponse(
                $request->input('idUser'),
                $request->input('idAnnonce'),
                $request->input('idStatus')
            );
    
            return response()->json(['status' => 'success']);
        }
        catch (\Exception $e) {
            \Log::error('Erreur réponse candidature: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Erreur lors de l\'envoi '], 500);
        }
    }

    public function GoToFormAnnonce() {
        // Récupère les types de contrats pour le formulaire d'annonce grâce à la méthode TypeContrat() du modèle DefaultModel
        return response()->json(['typeContrat' => $this->defaultModel->TypeContrat()]);
    }

    public function CreateAnnonce(Request $request) {
        // Crée une annonce et l'associe à une entreprise
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'typeContrat' => 'required',
            'dateDebut' => 'required',
            'codePostal' => 'required|min:5|max:5',
            'ville' => 'required',
        ]);

        try {
            $this->recruteurModel->CreateAnnonce($request->input('titre'), $request->input('description'), $request->input('typeContrat'), $request->input('salaireMin'), $request->input('salaireMax'), $request->input('duree'), $request->input('adresse'), $request->input('ville'), $request->input('codePostal'), $request->input('dateDebut'), $request->input('dateFin'), $request->input('idUser'));
            return response()->json(['success' => 'L\'annonce a bien été créée !'], 200);
        }
        catch (\Exception $e) {
            \Log::error('Erreur de création: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Une erreur est intervenue lors de la création.'], 500);
        }
    }

    public function DeleteAnnonce(Request $request) {
        // Supprime une annonce et les candidatures associées
        try {
            $this->recruteurModel->DeleteAnnonce($request->input('idAnnonce'));
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred during deletion'], 500);
        }
    }

    public function ChooseCorporate() {
        // Choix d'une entreprise (peut être utilisé pour associer des annonces à une entreprise)
        return response()->json(['corporates' => null]);
    }

    public function SearchCorporate(Request $request) {
        // Recherche d'entreprises 
        $defaultModel = new DefaultModel;
        return response()->json(['corporates' => $defaultModel->SearchCorporate($request->input('nameCorporate'))]);
    }

    public function RequestJoinCorporate(Request $request) {
        // Demande de rejoindre une entreprise 
        try {
            $defaultModel = new DefaultModel;
            $defaultModel->JoinCorporate($request->input('idEntreprise'), $request->input('idUser'));
            return response()->json(['status' => true]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    public function CreateCorporate(Request $request) {
        // Crée une entreprise et l'associe à un utilisateur
        try {
            $this->recruteurModel->CreateCorporate($request->input('idUser'), $request->input('nomEntreprise'), $request->input('descriptionEntreprise'), $request->input('siegeSocial'), $request->input('nbSalarie'));
            return response()->json(['status' => true]);   
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    public function RemoveCorporate(Request $request)
    {
        // Supprime une entreprise
        try {
            $this->recruteurModel->removeCorporate($request->input('id'));
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Erreur: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Une erreur est survenue'], 500);
        }
    }
}
