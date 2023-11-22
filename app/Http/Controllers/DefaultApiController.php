<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefaultModel;

class DefaultApiController extends Controller
{
    /**
     * Récupérer la liste des annonces et les détails associés.
     */
    public function Index() {
        $defaultModel = new DefaultModel;
        return response()->json([
            'nbAnnonces' => $defaultModel->GetNbAnnonces(),
            'typeContrat' => $defaultModel->TypeContrat(),
            'results' => null
        ]);
    }

    /**
     * Effectuer une recherche d'annonces avec des filtres.
     */
    public function RechercheAnnonceDefault(Request $request) { 
        $defaultModel = new DefaultModel;
        return response()->json([
            'results' => $defaultModel->GetAnnonces($request->input('search'), $request->input('ville'), $request->input('typeContrat')),
            'nbAnnonces' => $defaultModel->GetNbAnnonces(),
            'typeContrat' => $defaultModel->TypeContrat()
        ]);
    }

    /**
     * Mettre à jour le profil de l'utilisateur.
     */
    public function UpdateUser(Request $request) {
        try {
            $defaultModel = new DefaultModel;
            $defaultModel->UpdateUser(
                $request->input('id'),
                $request->input('identifiant'),
                $request->input('email'),
                $request->input('firstName'),
                $request->input('lastName'),
                $request->input('adresse'),
                $request->input('ville'),
                $request->input('tel')
            );
            return response()->json(['status' => true]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
