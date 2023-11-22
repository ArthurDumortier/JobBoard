@extends((session()->get('user')->roleId == 1) ? 'layout.administrateurMaster' : ((session()->get('user')->roleId == 2) ? 'layout.utilisateurMaster' : 'layout.recruteurMaster'))
@section('nomtitre')
Votre Profil
@endsection

@section('monbody')
Vos informations :
<div class="user">
</div>

<a href="{{route('GoToUpdateUserForm', ['id' => session()->get('user')->id])}}" ><button class="buttonInscription" id="modifierRight">Modifier</button></a>


<script src="{{asset('js/profilUserScript.js')}}"></script>
@endsection
