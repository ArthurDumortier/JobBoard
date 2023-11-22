@extends('layout.master')

@section('nomtitre')
Se Connecter
@endsection

@section('monbody')
<body>
    <form action="{{ route('verifConnection') }}" method="post">
      @csrf
      @method('get')
      <div class="title">
        <h1>Se Connecter</h1>
      </div>
      <div class="sectionForm">
        {{-- <label for="inputIdentifiant">Identifiant :</label> --}}
        <input type="text" id="inputIdentifiant" name="identifiant" placeholder="Identifiant" required autofocus>
        {{-- <label for="inputPassword">Mot de passe :</label> --}}
        <input type="password" id="inputPassword" name="password" placeholder="Mot de passe" required>
           
      @if ($errors->any())
        <div style="color: red;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <button type="submit" class="buttonInscription btn-seconnecter">Se connecter</button>
    </div> 
    </form>
</body>
@endsection
