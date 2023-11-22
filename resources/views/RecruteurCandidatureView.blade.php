@extends('layout.recruteurMaster')

@section('nomtitre')
Candidature
@endsection

@section('monbody')
Voici la candidature de <span class="firstName"></span> <span class="lastName"></span> pour l'annonce <span id="titre"></span> :
<div class="candidature">
    <h3>Informations du candidat :</h3>
    Nom : <span class="lastName"></span> <br>
    Prénom : <span class="firstName"></span> <br>
    CV : <span id="cv"></span> <br>
    Lettre de motivation : <span id="lettreMotivation"></span> <br>
    @if(session()->get('user')->roleId == 3 && session()->get('user')->isActive == 1)
    <form action="{{route('CandidatureResponse')}}" method="post">
        @csrf
        @method('get')
        <input type="hidden" {{--value="{{$candidature->idUser}}"--}} name="idUser" id="idUser">
        <input type="hidden" {{--value="{{$candidature->idAnnonce}}"--}} name="idAnnonce" id="idAnnonce">
        <div class="hidden"></div>
        <select name="idStatus" id="idStatus">
            <option value="">Choisir une réponse</option>
        </select>
        <input type="submit" value="Envoyer" >
    </form>
    @else 
    <div class="messageInfo">
        <p>Tu ne peux pas donner de réponse à cette candidature car tu n'as pas les droits</p>
    </div>
    @endif
</div>

<script src="{{asset('js/candidatureInfoScript.js')}}"></script>
@endsection