<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefaultModel;

class DefaultController extends Controller
{
    public function Index() {
        // Renvoie la vue 'accueilView' pour la page d'accueil.
        return view('accueilView');
    }

    public function GoToUpdateUserForm () {
        // Renvoie la vue 'ModifierProfilView' pour afficher le formulaire de mise à jour du profil utilisateur.
        return view('ModifierProfilView');
    }

    public function UpdateUser() {
        // Renvoie la vue 'ModifierProfilView' pour effectuer la mise à jour du profil utilisateur.
        return view('ModifierProfilView');
    }
}
