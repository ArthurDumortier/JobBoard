@extends((session()->get('user')->roleId == 1) ? 'layout.administrateurMaster' : ((session()->get('user')->roleId == 2)
? 'layout.utilisateurMaster' : 'layout.recruteurMaster'))
@section('nomtitre')
Modifier votre profil
@endsection

@section('monbody')
<form action="#" method="put" class="modifierForm">
     <input type="hidden" name="idEntreprise" id="idEntreprise" value="Loading...">
    <div class="inputForm">
        <label for="entrepriseName">Nom de l'entreprise :</label>
        <input type="text" name="entrepriseName" id="entrepriseName"  value="Loading...">
    </div>
    <div class="inputForm">
        <label for="description">Description :</label>
        <input type="text" name="description" id="description"  value="Loading...">
    </div>
    <div class="inputForm">
        <label for="siegeSocial">Siege social :</label>
        <input type="text" name="siegeSocial" id="siegeSocial" value="Loading...">
    </div>
    <div class="inputForm">
        <label for="nombreSalaries">Nombre de salariés :</label>
        <input type="text" name="nombreSalaries" id="nombreSalaries" value="Loading...">
    </div>
    <div class="input">
        <input type="submit" value="Modifier" class="buttonInscription">
    </div>
</form>
<script src="{{asset('js/adminUpdateEntreprise.js')}}"></script>
@endsection

// model updateAnnonce updateEntreprise