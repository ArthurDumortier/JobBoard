@extends('layout.recruteurMaster')

@section('nomtitre')
Rejoindre une entreprise
@endsection

@section('monbody')
<form action="#" method="POST">

    <label for="nameCorporate">Entrez le nom de l'entreprise</label>
    <input type="text" name="inputCorporate" id="inputCorporate">
</form>
<div class="cards" id="resultsSection">
    <!-- Les résultats des entreprises seront ajoutés ici dynamiquement -->
</div>
<script src="{{asset('js/chooseCorporate.js')}}"></script>
@endsection