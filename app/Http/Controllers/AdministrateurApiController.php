<?php

namespace App\Http\Controllers;

use App\Models\AnnonceModel;
use App\Models\DefaultModel;
use Illuminate\Http\Request;
use App\Models\EntrepriseModel;
use Illuminate\Support\Facades\DB;
use App\Models\AdministrateurModel;

class AdministrateurApiController extends Controller
{
    /**
     * Afficher une liste de ressources (non utilisé dans le code actuel).
     */
    public function index()
    {
        // Cette méthode est destinée à afficher une liste de ressources, mais elle n'est pas implémentée.
    }

    /**
     * Stocker une nouvelle ressource (non utilisé dans le code actuel).
     */
    public function store(Request $request)
    {
        // Cette méthode est destinée à stocker une nouvelle ressource, mais elle n'est pas implémentée.
    }

    /**
     * Afficher la ressource spécifiée (non utilisé dans le code actuel).
     */
    public function show(string $id)
    {
        // Cette méthode est destinée à afficher une ressource spécifique, mais elle n'est pas implémentée.
    }

    /**
     * Mettre à jour la ressource spécifiée (non utilisé dans le code actuel).
     */
    public function update(Request $request, string $id)
    {
        // Cette méthode est destinée à mettre à jour une ressource spécifique, mais elle n'est pas implémentée.
    }

    /**
     * Supprimer la ressource spécifiée (non utilisé dans le code actuel).
     */
    public function destroy(string $id)
    {
        // Cette méthode est destinée à supprimer une ressource spécifique, mais elle n'est pas implémentée.
    }

    /**
     * Obtenir le profil de l'administrateur en fonction de l'ID.
     */
    public function ProfileAdmin($id) {
        $defaultModel = new DefaultModel;
        return response()->json(['user' => $defaultModel->GetUser($id), 'id' => $id]);
    }

    /**
     * Supprimer un utilisateur en fonction de l'ID fourni dans la requête.
     */
    public function DeleteUser(Request $request) {
        try {
            $administrateurModel = new AdministrateurModel;
            $administrateurModel->DeleteUser($request->input('idUser'));
            return response()->json(['status' => true]);
        } catch(Exeception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Supprimer une entreprise en fonction de l'ID fourni dans la requête.
     */
    public function DeleteEntreprise(Request $request) {
        try {
            $administrateurModel = new AdministrateurModel;
            $administrateurModel->DeleteEntreprise($request->input('idEntreprise'));
            return response()->json(['status' => true]);
        } catch(Exeception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Obtenir les informations d'une annonce en fonction de l'ID fourni.
     */
    public function GetAnnonce($id) {
        $defaultModel = new DefaultModel;
        $annonce = AnnonceModel::find($id);
        return response()->json(['annonce' => $annonce, 'typeContrat' => $defaultModel->TypeContrat()]);
    }

    /**
     * Obtenir les informations d'une entreprise en fonction de l'ID fourni.
     */
    public function GetEntreprise($id) {
        $defaultModel = new DefaultModel;
        $entreprise = EntrepriseModel::find($id);
        return response()->json(['entreprise' => $entreprise, 'domaine' => $defaultModel->GetDomaine()]);
    }

    /**
     * Mettre à jour les informations d'une entreprise en fonction des données fournies dans la requête.
     */
    public function UpdateEntreprise(Request $request) {
        try {
            $administrateurModel = new AdministrateurModel;
            $administrateurModel->UpdateEntreprise($request->input('idEntreprise'), $request->input('entrepriseName'), $request->input('description'), $request->input('siegeSocial'), $request->input('nombreSalaries'));
            return response()->json(['status' => true]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Mettre à jour les informations d'une annonce en fonction des données fournies dans la requête.
     */
    public function UpdateAnnonce(Request $request) {
        try {
            $administrateurModel = new AdministrateurModel;
            $administrateurModel->UpdateAnnonce($request->input('idAnnonce'), $request->input('titre'), $request->input('description'), $request->input('typeContrat'), $request->input('salaireMin'), $request->input('salaireMax'), $request->input('duration'), $request->input('adresse'), $request->input('ville'), $request->input('codePostal'));
            return response()->json(['status' => true]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Obtenir la liste des rôles (non utilisé dans le code actuel).
     */
    public function GetRole() {
        $administrateurModel = new AdministrateurModel;
        return response()->json(['role' => $administrateurModel->GetRole()]);
    }

    /**
     * Créer un nouvel utilisateur en fonction des données fournies dans la requête.
     */
    public function CreateUser(Request $request) {
        try {
            $administrateurModel = new AdministrateurModel;
            $administrateurModel->CreateUser($request->input('identifiant'), $request->input('password'), $request->input('role'), $request->input('email'), $request->input('firstName'), $request->input('lastName'), $request->input('adresse'), $request->input('codePostal'), $request->input('ville'), $request->input('tel'), $request->input('isActive'), $request->input('pays'));
            return response()->json(['status' => true]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
