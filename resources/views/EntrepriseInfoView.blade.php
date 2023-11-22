@extends(((session()->get('user') === null) ? 'layout.master' : ((session()->get('user')->roleId == 2) ? 'layout.utilisateurMaster' :
'layout.recruteurMaster')))
@section('nomtitre')
Entreprise Info
@endsection

@section('monbody')
<div class="infoEntreprise">
    <h3><span id="nomEntreprise"></span></h3> <br>
    <p class="description-coupe">Description : <span id="descriptionEntreprise"></span>
    </p>
    Nombre salarié : <span id="nbSalarie"></span> <br>
    Siège social : <span id="siegeSocial"></span> <br>
</div>
<div class="infoSalaries">
    <div class="salaries"></div>
</div>
<div class="infoReseaux">
    <div class="reseaux"></div>
</div>
<div class="infoDomaines">
    <div class="domaines"></div>
</div>
<div class="nbOffres">
    Nombres d'annonces crée par l'entreprise : <span id="nbOffres"></span>
</div>

<script src="{{asset('js/entrepriseInfo.js')}}"></script>
@endsection