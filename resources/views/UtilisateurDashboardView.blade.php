@extends('layout.utilisateurMaster')

@section('nomtitre')
Accueil Utilisateur
@endsection

@section('monbody')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h1>Accueil Utilisateur</h1>
                <p>Bienvenue <span id="nomPrenom"></span> sur votre page d'accueil</p>
            </div>
        </div>
        <div class="block">
            <form action="#" method="post" class="modifierForm">
                <input type="text" name="search" id="search" placeholder="Rechercher une annonce">
                <input type="text" name="ville" id="ville" placeholder="Ville">
                <select name="typeContrat" id="typeContrat">
                    <option value="">-- Type de Contrat --</option>
                    <div class="typeContrat"></div>
                </select>
            </form>
        </div>
        <div class="cards" id="resultsSection">
            <!-- Les résultats des annonces seront ajoutés ici dynamiquement -->
        </div>
    </div>
</div>
<script src="{{ asset('js/utilisateurDashboardScript.js') }}"></script>
@endsection