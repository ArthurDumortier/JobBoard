<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\RecruteurController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\DefaultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DefaultController::class, 'Index'])->name('Index');
Route::get('Connection', [ConnectionController::class, 'Connection'])->name('Connection');
Route::get('Inscription', [InscriptionController::class, 'Inscription'])->name('Inscription');
Route::get('verifConnection', [ConnectionController::class, 'VerifConnection'])->name('verifConnection');
Route::get('add', [InscriptionController::class,"AddUser"])->name('addUser');

Route::middleware(['connected'])->group(function() {
    Route::get('AdministrateurDashboard/{id}', [AdministrateurController::class, 'IndexAdmin'])->name('AdministrationDashboard');
    Route::get('AdministrateurDashboard/{id}/profil', [AdministrateurController::class, 'ProfileAdmin'])->name('AdministrateurProfil');
    Route::get('AdministrateurDashboard/{id}/user', [AdministrateurController::class, 'UsersAdmin'])->name('AdministrateurUser');
    Route::get('AdministrateurDashboard/{id}/annonce', [AdministrateurController::class, 'AnnonceAdmin'])->name('AdministrateurAnnonce');
    Route::get('AdministrateurDashboard/{id}/entreprise', [AdministrateurController::class, 'EntrepriseAdmin'])->name('AdministrateurEntreprise');
    Route::get('UtilisateurDashboard/{id}', [UtilisateurController::class, 'IndexUser'])->name('UtilisateurDashboard'); 
    Route::get('UtilisateurDashboard/{id}/profil', [UtilisateurController::class, 'ProfileUser'])->name('ProfilUser');
    Route::get('UtilisateurDashboard/{id}/candidature', [UtilisateurController::class, 'CandidatureUser'])->name('CandidatureUser');
    Route::get('UtilisateurDashboard/{id}/candidature/{idCandidature}', [UtilisateurController::class, 'TheCandidatureUser'])->name('LaCandidatureUser');
    Route::get('UtilisateurDashboard/{id}/messages', [UtilisateurController::class, 'MessagesUser'])->name('MessagesUser');
    Route::get('RecruteurDashboard/{id}', [RecruteurController::class, 'IndexRecruteur'])->name('RecruteurDashboard');
    Route::get('RecruteurDashboard/{id}/profil', [RecruteurController::class, 'ProfileRecruteur'])->name('RecruteurProfil');
    Route::get('RecruteurDashboard/{id}/Choose', [RecruteurController::class, 'ChooseCorporate'])->name('ChooseCorporate');
});
Route::get('UpdateUser/{id}', [DefaultController::class, 'GoToUpdateUserForm'])->name('GoToUpdateUserForm');
Route::get('UpdateAnnonce/{id}', [AdministrateurController::class, 'GoToUpdateAnnonceForm'])->name('GoToUpdateAnnonceForm');
Route::get('UpdateEntreprise/{id}', [AdministrateurController::class, 'GoToUpdateEntrepriseForm'])->name('GoToUpdateEntrepriseForm');
Route::get('AdministateurDashboard/{id}/CreateUser', [AdministrateurController::class, 'CreateUser'])->name('CreateUser');
Route::get('CreateAnnonce', [RecruteurController::class, 'CreateAnnonce'])->name('CreateAnnonce');
Route::get('CandidatureResponse', [RecruteurController::class, 'CandidatureResponse'])->name('CandidatureResponse');
Route::get('GoToFormAnnonce', [RecruteurController::class, 'GoToFormAnnonce'])->name('GoToFormAnnonce');
Route::get('CreateCorporate', [RecruteurController::class, 'CreateCorporate'])->name('CreateCorporate');
Route::get('CandidatureInfo/{postuleurId}', [RecruteurController::class, 'CandidatureInfo'])->name('CandidatureInfo');
Route::get('FormCreateCorporate', [RecruteurController::class, 'FormCreateCorporate'])->name('FormCreateCorporate');
Route::get('RequestJoinCorporate/{idEntreprise}', [RecruteurController::class, 'RequestJoinCorporate'])->name('JoinCorporate');
Route::get('Postuler', [UtilisateurController::class, 'Postuler'])->name('Postuler');   
Route::get('logout', [ConnectionController::class, 'Logout'])->name('logout');
Route::get('AnnonceInfo/{id}', [UtilisateurController::class, 'AnnonceInfo'])->name('AnnonceInfo');
Route::get('EntrepriseInfo/{id}', [UtilisateurController::class, 'EntrepriseInfo'])->name('EntrepriseInfo');

