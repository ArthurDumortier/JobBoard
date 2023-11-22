@extends('layout.recruteurMaster')

@section('nomtitre')
Créer une entreprise
@endsection

@section('monbody')
<h3>Formulaire de création d'entreprise</h3>
<form action="#" method="POST" class="modifierForm">
    <div class="inputForm">
        <label for="nomEntreprise">Nom de l'entreprise : </label>
        <input type="text" id="nomEntreprise" name="nomEntreprise" placeholder="Nom de l'entreprise" required>
    </div>
    <div class="inputForm">
        <label for="descriptionEntreprise">Description</label>
        <textarea id="descriptionEntreprise" name="descriptionEntreprise" rows="4"></textarea>
    </div>
    <div class="inputForm">
        <label for="siegeSocial">Siege social</label>
        <input type="text" id="siegeSocial" name="siegeSocial" placeholder="Siege social">
    </div>
    <div class="inputForm">
        <label for="nbSalarie">Nombre de salariés :</label>
        <input type="number" id="nbSalarie" name="nbSalarie" placeholder="Nombre de salariés">
    </div>
    <div class="input">
        <input type="submit" value="Créer">
    </div>
</form>
<script src="{{asset('js/createCorporate.js')}}"></script>
@endsection