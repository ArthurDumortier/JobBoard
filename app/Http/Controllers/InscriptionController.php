<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscriptionModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InscriptionController extends Controller
{
    public function Inscription()
    {
        return view('InscriptionView');
    }

    public function AddUser(Request $request)
    {
         // Validation des données d'inscription
         $request->validate([
            'TypePersonne' => 'required|not_in:0', // Le champ "TypePersonne" est requis et ne doit pas être égal à 0.
            'Identifiant' => 'required|min:5', // Le champ "Identifiant" est requis et doit avoir une longueur minimale de 5 caractères.
            'Password' => 'required|min:10|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/u', // Le champ "Password" est requis, doit avoir une longueur minimale de 10 caractères et doit satisfaire au modèle de regex (lettres minuscules, majuscules et chiffres).
            'PasswordConfirm' => 'required|min:10|same:Password', // Le champ "PasswordConfirm" est requis, doit correspondre au champ "Password" et avoir une longueur minimale de 10 caractères.
            'FirstName' => 'required|regex:/^[a-zA-Z]+$/u', // Le champ "FirstName" est requis et doit contenir uniquement des lettres alphabétiques (minuscules et majuscules).
            'LastName' => 'required|regex:/^[a-zA-Z]+$/u', // Le champ "LastName" est requis et doit contenir uniquement des lettres alphabétiques (minuscules et majuscules).
            'Email' => 'required|email', // Le champ "Email" est requis et doit être une adresse email valide.
            'Address' => 'required', // Le champ "Address" est requis.
            'Ville' => 'required', // Le champ "Ville" est requis.
            'CodePostal' => 'required|min:5|max:5', // Le champ "CodePostal" est requis et doit avoir une longueur minimale et maximale de 5 caractères.
            'TelNum' => 'required|min:10|max:14', // Le champ "TelNum" est requis et doit avoir une longueur minimale de 10 caractères et maximale de 14 caractères.
            'Pays' => 'required' // Le champ "Pays" est requis.
        ]);

        // Appel de la méthode "AddUser" du modèle "InscriptionModel" pour ajouter l'utilisateur.
        (new InscriptionModel)->AddUser(
            $request->input('Identifiant'),
            $request->input('Password'),
            $request->input('TypePersonne'),
            $request->input('FirstName'),
            $request->input('LastName'),
            $request->input('Email'),
            $request->input('Address'),
            $request->input('Ville'),
            $request->input('CodePostal'),
            $request->input('TelNum'),
            $request->input('Pays')
        );

        return view('ConnectionView');
    }

}
