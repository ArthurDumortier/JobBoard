@extends('layout.recruteurMaster')

@section('nomtitre')
Crée une annonce
@endsection

@section('monbody')
<h3>Formulaire de création d'annonces</h3>
<form action="{{route('CreateAnnonce')}}" method="POST" class="modifierForm">
    @csrf
    @method('get')
    <div class="inputForm">
        <label for="titre">Titre : </label>
        <input type="text" id="titre" name="titre" placeholder="Titre de l'annonce" required>
    </div>
    <div class="inputForm">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>
    </div>
    <div class="inputForm">
        <label for="typeContrat">Type de Contrat :</label>
        <select name="typeContrat" id="typeContrat" required>
            <option value="">-- Type de Contrat --</option>
        </select>
    </div>
    <div class="inputForm">
        <label for="salaireMin">Salaire Minimum par An (optionnel)</label>
        <input type="number" id="salaireMin" name="salaireMin">
    </div>
    <div class="inputForm">
        <label for="salaireMax">Salaire Maximum par An (optionnel)</label>
        <input type="number" id="salaireMax" name="salaireMax">
    </div>
    <div class="inputForm">
        <label for="duree">Durée de la mission (mois)</label>
        <input type="number" id="duree" name="duree">
    </div>
    <div class="inputForm">
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse">
    </div>
    <div class="inputForm">
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville">
    </div>
    <div class="inputForm">
        <label for="codePostal">Code Postal</label>
        <input type="number" id="codePostal" name="codePostal">
    </div>
    <div class="inputForm">
        <label for="dateDebut">Date de début</label>
        <input type="date" id="dateDebut" name="dateDebut">
    </div>
    <div class="inputForm">
        <label for="dateFin">Date de fin</label>
        <input type="date" id="dateFin" name="dateFin">
    </div>
    <div class="input">
        <button type="submit" class="buttonInscription">Créer l'annonce</button>
    </div>
</form>
<script src="{{asset('js/annonceCreateScript.js')}}"></script>
@endsection