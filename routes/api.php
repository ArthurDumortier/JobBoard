<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnoncesAPIController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\DefaultApiController;
use App\Http\Controllers\RecruteurApiController;
use App\Http\Controllers\EntrepriseAPIController;
use App\Http\Controllers\InscriptionApiController;
use App\Http\Controllers\UtilisateurApiController;
use App\Http\Controllers\AdministrateurApiController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/annonces', AnnoncesAPIController::class) -> only(['index']);
Route::resource('/entreprise', EntrepriseAPIController::class) -> only(['index']);
Route::resource('/utilisateur', UtilisateurAPIController::class) -> only(['index']);

Route::get('/', [DefaultApiController::class, 'Index'])->name('API.Index');
Route::get('admin-dashboard/{id}', [AdministrateurApiController::class, 'IndexAdmin'])->name('API.AdministrationDashboard');
Route::get('admin-dashboard/{id}/profile', [AdministrateurApiController::class, 'ProfileAdmin'])->name('API.AdministrateurProfil');

Route::get('getrole', [AdministrateurApiController::class, 'GetRole'])->name('API.GetRole');
Route::post('create-user', [AdministrateurApiController::class, 'CreateUser'])->name('API.CreateUser');
Route::get('user-dashboard/{id}', [UtilisateurApiController::class, 'IndexUser'])->name('API.UtilisateurDashboard');
Route::get('user-dashboard/{id}/profile', [UtilisateurApiController::class, 'ProfileUser'])->name('API.ProfilUser');
Route::get('user-dashboard/{id}/candidature', [UtilisateurApiController::class, 'CandidatureUser'])->name('API.CandidatureUser');
Route::get('user-dashboard/{id}/candidature/{idCandidature}', [UtilisateurApiController::class, 'TheCandidatureUser'])->name('API.LaCandidatureUser');
Route::get('user-dashboard/{id}/messages', [UtilisateurApiController::class, 'MessagesUser'])->name('API.MessagesUser');

Route::get('recruteur-dashboard/{id}', [RecruteurApiController::class, 'IndexRecruteur'])->name('API.RecruteurDashboard');
Route::get('recruteur-dashboard/{id}/profile', [RecruteurApiController::class, 'ProfileRecruteur'])->name('API.RecruteurProfil');
Route::get('recruteur-dashboard/{id}/choose', [RecruteurApiController::class, 'ChooseCorporate'])->name('API.ChooseCorporate');

Route::put('update-user', [DefaultApiController::class, 'UpdateUser'])->name('API.UpdateUser');
Route::put('update-entreprise', [AdministrateurApiController::class, 'UpdateEntreprise'])->name('API.UpdateEntreprise');
Route::put('update-annonce', [AdministrateurApiController::class, 'UpdateAnnonce'])->name('API.UpdateAnnonce');

Route::get('get-annonce/{id}', [AdministrateurApiController::class, 'GetAnnonce'])->name('API.GetAnnonce');
Route::get('get-entreprise/{id}', [AdministrateurApiController::class, 'GetEntreprise'])->name('API.GetEntreprise');
Route::put('remove-corporate', [RecruteurApiController::class, 'RemoveCorporate'])->name('API.RemoveCorporate');
Route::post('create-annonce', [RecruteurApiController::class, 'CreateAnnonce'])->name('API.CreateAnnonce');
Route::put('candidature-response', [RecruteurApiController::class, 'CandidatureResponse'])->name('API.CandidatureResponse');
Route::get('count-postuler/{idAnnonce}/{idUser}', [RecruteurApiController::class, 'CountPostuler'])->name('API.CountPostuler');
Route::delete('delete-annonce', [RecruteurApiController::class, 'DeleteAnnonce'])->name('API.DeleteAnnonce');
Route::delete('delete-entreprise', [AdministrateurApiController::class, 'DeleteEntreprise'])->name('API.DeleteEntreprise');
Route::delete('delete-user', [AdministrateurApiController::class, 'DeleteUser'])->name('API.DeleteUser');
Route::get('go-to-form-annonce', [RecruteurApiController::class, 'GoToFormAnnonce'])->name('API.GoToFormAnnonce');
Route::post('create-corporate', [RecruteurApiController::class, 'CreateCorporate'])->name('API.CreateCorporate');
Route::get('candidature-info/{postuleurId}', [RecruteurApiController::class, 'CandidatureInfo'])->name('API.CandidatureInfo');
Route::post('request-join-corporate', [RecruteurApiController::class, 'RequestJoinCorporate'])->name('API.JoinCorporate');
Route::post('search-corporate', [RecruteurApiController::class, 'SearchCorporate'])->name('API.SearchCorporate');
Route::post('postuler', [UtilisateurApiController::class, 'Postuler'])->name('API.Postuler');
Route::post('postuler-non-connecter', [UtilisateurApiController::class, 'PostulerNonConnecter'])->name('API.PostulerNonConnecter');
Route::get('logout', [ConnectionController::class, 'Logout'])->name('API.Logout');
Route::get('add', [InscriptionApiController::class,"AddUser"])->name('API.AddUser');
Route::post('recherche-annonce-default', [DefaultApiController::class, 'RechercheAnnonceDefault'])->name('API.RechercheAnnonceDefault');
Route::get('annonce-info/{id}', [UtilisateurApiController::class, 'AnnonceInfo'])->name('API.AnnonceInfo');
Route::get('entreprise-info/{id}', [UtilisateurApiController::class, 'EntrepriseInfo'])->name('API.EntrepriseInfo');