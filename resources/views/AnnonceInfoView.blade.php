@extends((session()->get('user') === null) ? 'layout.master' : ((session()->get('user')->roleId == 2) ? 'layout.utilisateurMaster' :
'layout.recruteurMaster'))
@section('nomtitre')
Annonce
@endsection

@section('monbody')
<div class="title">
    <p><span id="titre"></span></p>
</div>

<div class="anonce">
    <div class="infoEntreprise" id="infoEntreprise">
    </div>
    <div class="infoAnnonce" id="infoAnnonce">
    </div>
    <div class="candidatures" id="candidatures"></div>
</div>

<div class="annonceButton" id="annonceButton">
</div>
<script src="{{asset('js/annonceInfo.js')}}"></script>
@endsection