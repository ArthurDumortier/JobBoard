@extends((session()->get('user')->roleId == 1) ? 'layout.administrateurMaster' : ((session()->get('user')->roleId == 2)
? 'layout.utilisateurMaster' : 'layout.recruteurMaster'))
@section('nomtitre')
Modifier votre profil
@endsection

@section('monbody')
<form action="#" method="put" class="modifierForm">
    <input type="hidden" name="id" id="id" value="Loading...">
        <div class="inputForm">
            <label for="identifiant">Identifiant :</label>
            <input type="text" name="identifiant" id="identifiant" value="Loading...">
        </div>
        <div class="inputForm">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="Loading...">
        </div>
        <div class="inputForm">
            <label for="firstName">Prénom :</label>
            <input type="text" name="firstName" id="firstName" value="Loading...">
        </div>
        <div class="inputForm">
            <label for="lastName">Nom :</label>
            <input type="text" name="lastName" id="lastName" value="Loading...">
        </div>
        <div class="inputForm">
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" value="Loading...">
        </div>
        <div class="inputForm">
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" value="Loading...}">
        </div>
        <div class="inputForm">
            <label for="tel">Telephone :</label>
            <input type="text" name="tel" id="tel" value="Loading...">
        </div>
        <div class="input">
            <input type="submit" value="Modifier" class="buttonInscription">
        </div>
</form>
<script src="{{asset('js/updateUser.js')}}"></script>
@endsection