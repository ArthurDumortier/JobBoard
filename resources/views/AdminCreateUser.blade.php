@extends('layout.administrateurMaster')

@section('nomtitre')
Créer un utilisateur
@endsection

@section('monbody')
<h3>Formulaire de création d'utilisateur</h3>
<form action="#" method="post" class="modifierForm">
    <div class="inputForm">
        <label for="identifiant">Identifiant</label>
        <input type="text" id="identifiant" name="identifiant" placeholder="Identifiant" required>
    </div>
    <div class="inputForm">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
    </div>
    <div class="inputForm">
        <label for="role">Role</label>
        <select name="role" id="role" required>
            <option value="">-- Role --</option>
            {{-- ajouter les roles dynamiquement --}}
        </select>
    </div>
    <div class="inputForm">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="inputForm">
        <label for="firstName">Prénom</label>
        <input type="text" id="firstName" name="firstName" placeholder="Prénom" required>
    </div>
    <div class="inputForm">
        <label for="lastName">Nom</label>
        <input type="text" id="lastName" name="lastName" placeholder="Nom" required>
    </div>
    <div class="inputForm">
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse" placeholder="Adresse">
    </div>
    <div class="inputForm">
        <label for="codePostal">Code Postal</label>
        <input type="number" id="codePostal" name="codePostal" placeholder="Code Postal">
    </div>
    <div class="inputForm">
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" placeholder="Ville">
    </div>
    <div class="inputForm">
        <label for="tel">Telephone</label>
        <input type="text" id="tel" name="tel" placeholder="Telephone">
    </div>
    <div class="inputForm">
        <label for="isActive">Ayant droit</label>
        <select name="isActive" id="isActive" required>
            <option value="">-- Ayant droit --</option>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
    </div>
    <div class="inputForm">
        <label for="pays">Pays</label>
        <input type="text" name="pays" id="pays" placeholder="Pays">
    </div>
    <input type="submit" value="Crée utilisateur" class="buttonInscription">
</form>

<script src="{{asset('js/createUser.js')}}"></script>
@endsection