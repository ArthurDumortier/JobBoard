@extends('layout.recruteurMaster')

@section('nomtitre')
Accueil Recruteur
@endsection

@section('monbody')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h1>Accueil Recruteur</h1>
                <p>Bienvenue <span id="nomPrenom"></span> sur votre page d'accueil</p>
            </div>
            <div id="demande"></div>
        </div>
        <h4>Les annonces crée par votre entreprise :</h4>
        <div class="annonces"></div>
    </div>
</div>

<script src="{{asset('js/recruteurDashboard.js')}}"></script>
@endsection