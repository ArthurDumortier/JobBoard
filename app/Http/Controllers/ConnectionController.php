<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class ConnectionController extends Controller
{
    /**
     * Afficher la page de connexion.
     */
    public function Connection()
    {
        return view('ConnectionView');
    }

    /**
     * Vérifier les informations de connexion et authentifier l'utilisateur.
     */
    public function VerifConnection(Request $request)
    {
        $request->validate([
            'identifiant' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('identifiant', 'password');

        $user = User::where('identifiant', $credentials['identifiant'])->first();
        if (isset($user) && Hash::check($credentials['password'], $user->password)) {
            // Les identifiants sont valides
            $user->remember_token = Str::random(60);
            $sql = "UPDATE user SET remember_token = ? WHERE identifiant = ?";
            DB::update($sql, [$user->remember_token, $user->identifiant]);

            Auth::login($user, $request->has('remember'));
            // on stocke le remember_token, user dans la session
            $request->session()->put('remember_token', $user->remember_token);
            $request->session()->put('user', $user);
            $request->session()->put('is_initial_login', true);

            if ($user->roleId == 1) {
                // Rôle administrateur
                return redirect()->route('AdministrationDashboard', ['id' => $user->id]);
            } elseif ($user->roleId == 2) {
                // Rôle utilisateur
                return redirect()->route('UtilisateurDashboard', ['id' => $user->id]);
            } elseif ($user->roleId == 3) {
                // Rôle recruteur
                return redirect()->route('RecruteurDashboard', ['id' => $user->id]);
            }
        }
        return redirect()->back()->withErrors([
            'Identifiant ou mot de passe incorrect.'
        ]);
    }

    /**
     * Déconnecter l'utilisateur et supprimer le remember_token.
     */
    public function Logout(Request $request)
    {
        $credentialsId = $request->session()->get('user')->id;
        $credentialsIdentifiant = $request->session()->get('user')->identifiant;
        $user = User::where('id', $credentialsId)->first();

        if ($user) {
            $user = $request->session()->get('user');
            $request->session()->put('user', $user);

            $sql = "UPDATE user SET remember_token = NULL WHERE id = ?";
            DB::update($sql, [$user->id]);

            Auth::logout();
            $request->session()->forget('remember_token');
            $request->session()->forget('user');
        }
        return redirect('/');
    }
}
