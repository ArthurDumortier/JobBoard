@extends((session()->get('user')->roleId == 1) ? 'layout.administrateurMaster' : 'layout.recruteurMaster')
@section('nomtitre')
Modifier votre profil
@endsection

@section('monbody')
<form action="#" method="put" class="modifierForm">
     <input type="hidden" name="idAnnonce" id="idAnnonce" value="Loading...">
    <div class="inputForm">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre"  value="Loading...">
    </div>
    <div class="inputForm">
        <label for="description">Description :</label>
        <input type="text" name="description" id="description"  value="Loading...">
    </div>
    <div class="inputForm">
        <label for="typeContrat">Type de contrat :</label>
        <select name="typeContrat" id="typeContrat">
            <option value=""></option>
        </select>
    </div>
    <div class="inputForm">
        <label for="salaireMin">Salaire minimum :</label>
        <input type="text" name="salaireMin" id="salaireMin" value="Loading...">
    </div>
    <div class="inputForm">
        <label for="salaireMax">Salaire maximum :</label>
        <input type="text" name="salaireMax" id="salaireMax" value="Loading...">
    </div>
    <div class="inputForm">
        <label for="duration">Durée :</label>
        <input type="text" name="duration" id="duration" value="Loading...">
    </div>
    <div class="inputForm">
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="Loading...">
    </div>
    <div class="inputForm">
        <label for="ville">Ville :</label>
        <input type="text" name="ville" id="ville" value="Loading...">
    </div>
    <div class="inputForm">
        <label for="codePostal">Code postal :</label>
        <input type="text" name="codePostal" id="codePostal" value="Loading...}">
    </div>
    <div class="input">
        <input type="submit" value="Modifier" class="buttonInscription">
    </div>
</form>
<script src="{{asset('js/adminUpdateAnnonce.js')}}"></script>
@endsection