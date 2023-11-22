<?php

namespace App\Http\Controllers;

//importation des classes pour permettre l'accés aux données des requêtes HTTP
use Illuminate\Http\Request;
use App\Models\DefaultModel;

// Ajout des views dans la class pour que chaque fonctions retourne une view (visuel de l'application)
class AdministrateurController extends Controller
{
    //retourne la partie visuel de la page d'accueil de l'administrateur
    public function IndexAdmin() {
        return view('AdministrateurDashboardView');
    }

    //retourne la partie visuel de la page contenant les informations de l'administrateur
    public function ProfileAdmin() {
        return view('UtilisateurProfileView');
    }

    //retourne la partie visuel de la page contenant les informations relatives aux utilisateurs
    //l'administrateur pourra modifier les informations ou le supprimer
    public function UsersAdmin() {
        return view('AdministrateurUtilisateur');
    }

    //retourne la partie visuel de la page contenant les informations concernant les annonces
    //l'administrateur pourra modifier les informations ou supprimer une ou des offres d'emploi
    public function annonceAdmin() {
        return view('AdministrateurAnnonce');
    }

    //retourne la partie visuel de la page contenant les informations des entreprises
    //l'administrateur pourra modifier les informations ou les supprimer
    public function EntrepriseAdmin() {
        return view('AdministrateurEntreprise');
    }

    public function GoToUpdateAnnonceForm() {
        return view('AdminModifierAnnonceView');
    }

    public function GoToUpdateEntrepriseForm() {
        return view('AdminModifierEntrepriseView');
    }

    public function CreateUser() {
        return view('AdminCreateUser');
    }
}
