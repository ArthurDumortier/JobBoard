<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsConnected
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const ROLE_RECRUITER = 3;

    public function handle(Request $request, Closure $next): Response
    {
        $sessionToken = $request->session()->get('remember_token');
        $isInitialLogin = $request->session()->get('is_initial_login');
        $user = $request->session()->get('user');
        $userRole = $user ? $user->roleId : null;

        // Vérifier si l'utilisateur est authentifié
        if ($sessionToken) {
            // L'utilisateur est authentifié
            if ($request->routeIs('Connection')) {
                $request->session()->forget('is_initial_login'); // Supprimer la variable de session après l'utilisation
                return $this->redirectToDashboard($userRole, $request);
            }
            
            // Vérifier si l'ID dans l'URL est égal à l'ID dans la session
            if ($request->route('id') != $user->id) {
                // Rediriger ou prendre une autre action en cas de non-correspondance
                abort(403, 'Vous n\'avez pas accès à cette page.');
            }
        } else {
            // L'utilisateur n'est pas authentifié, redirigez-le vers la page de connexion
            if (!$request->routeIs('Connection') || $isInitialLogin) {
                return redirect()->route('Connection');
            }
        }

        // Vérification des autorisations en fonction du rôle de l'utilisateur
        if ($userRole) {
            if (!$this->checkRoleAccess($request->route(), $userRole)) {
                abort(403, 'Vous n\'avez pas accès à cette page.');
            }
        }

        // L'utilisateur est authentifié ou accède à la page de connexion, continuez avec la demande
        return $next($request);
    }

    private function redirectToDashboard($userRole, $request)
    {
        switch ($userRole) {
            case self::ROLE_ADMIN:
                return redirect()->route('AdministrationDashboard', ['id' => $request->session()->get('user')->id]);
            case self::ROLE_USER:
                return redirect()->route('UtilisateurDashboard', ['id' => $request->session()->get('user')->id]);
            case self::ROLE_RECRUITER:
                return redirect()->route('RecruteurDashboard', ['id' => $request->session()->get('user')->id]);
            default:
                // Rediriger vers une page par défaut ou gérer d'une autre manière
                return redirect()->route('Connection');
        }
    }

    private function checkRoleAccess($route, $userRole)
    {
        // Ajoutez des conditions pour vérifier si l'utilisateur a accès à cette route en fonction de son rôle
        switch ($userRole) {
            case self::ROLE_ADMIN:
                // Vérifiez si l'administrateur a accès à la route
                return true;
            case self::ROLE_USER:
                // Vérifiez si l'utilisateur a accès à la route
                return $route->getName() === 'UtilisateurDashboard' || $route->getName() === 'ProfilUser' || $route->getName() === 'CandidatureUser' || $route->getName() === 'LaCandidatureUser' || $route->getName() === 'MessagesUser' || $route->getName() === 'RechercheAnnonce' || $route->getName() === 'AnnonceInfo' || $route->getName() === 'Postuler';
            case self::ROLE_RECRUITER:
                // Vérifiez si le recruteur a accès à la route
                return $route->getName() === 'RecruteurDashboard' || $route->getName() === 'RecruteurProfil' || $route->getName() === 'CandidatureInfo' || $route->getName() === 'CandidatureResponse' || $route->getName() === 'GoToFormAnnonce' || $route->getName() === 'CreateAnnonce' || $route->getName() === 'ChooseCorporate' || $route->getName() === 'SearchCorporate' || $route->getName() === 'logout';
            default:
                return false;
        }
    }
}