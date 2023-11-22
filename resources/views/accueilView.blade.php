@extends('layout.master')

@section('nomtitre')
    Job Board
@endsection

@section('monbody')
    <div class="title">
        <h6>Notre application, vous aider à choisir le vôtre parmi <span id="nbAnnonces">0</span> offres.</h6>
    </div>
    <div class="search">
        <form action="#" method="post">
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

    <script src="{{ asset('js/accueilScript.js') }}"></script>
@endsection