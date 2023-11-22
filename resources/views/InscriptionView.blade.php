@extends('layout.master')

@section('nomtitre')
S'inscrire
@endsection

@section('monbody')
<body>
    <form action="{{ route('addUser')}}" method="POST">
      @csrf
      @method('GET')
      <div class="title"">
        <h1>Formulaire d'inscription</h1>
      </div>
      <div class="sectionForm">
        <label for="inputTypePersonne">Type de personne :</label>
        <select name="TypePersonne" id="inputTypePersonne">
          <option value="">-- Choisie une option --</option>
          <option value="2">Utilisateur</option>
          <option value="3">Recruteur</option>
        </select>
      </div>
      <div class="sectionForm">
        <label for="inputIdentifiant">Identifiant :</label>
        <input type="text" id="inputIdentifiant" name="Identifiant" required autofocus>
      </div>
      <div class="sectionForm">
        <label for="inputEmail">Email :</label>
        <input type="email" id="inputEmail"  name="Email" placeholder="frank.ronald@gmail.com" required>        
      </div>
      <div class="sectionForm">
        <label for="inputPassword">Mot de passe :</label>
        <input type="password" id="inputPassword"  name="Password" required>        
      </div>
      <div class="sectionForm">
        <label for="inputPasswordConfirm">Confirmer le mot de passe :</label>
        <input type="password" id="inputPasswordConfirm"  name="PasswordConfirm" required>        
      </div>
      <div class="sectionForm">
        <label for="inputFirstName">Prenom :</label>
        <input type="text" id="inputFirstName"  name="FirstName" placeholder="Frank" required>        
      </div>
      <div class="sectionForm">
        <label for="inputLastName">Nom :</label>
        <input type="text" id="inputLastName"  name="LastName" placeholder="Ronald" required>        
      </div>
      <div class="sectionForm">
        <label for="inputAddress">Adresse :</label>
        <input type="text" id="inputAddress"  name="Address" placeholder="5 rue Jean Macé" required>
      </div>
      <div class="sectionForm">
        <label for="inputCodePostal">Code Postal :</label>
        <input type="number" id="inputCodePostal"  name="CodePostal" placeholder="75000" required>
      </div>
      <div class="sectionForm">
        <label for="inputVille">Ville :</label>
        <input type="text" id="inputVille"  name="Ville" placeholder="Lyon" required>
      </div>
      <div class="sectionForm">
        <label for="inputTelNum">Numéro de téléphone :</label>
        <input type="tel" id="inputTelNum"  name="TelNum" placeholder="06.00.00.00.00" required>
      </div>
      <div class="sectionForm">
        <label for="inputPays">Pays :</label>
        <input type="text" id="inputPays"  name="Pays" placeholder="France" required>
      </div>
      @if ($errors->any())
        <div style="color: red;">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <button type="submit" class="buttonInscription btn-seconnecter">Créer son compte</button>
    </form>
    <br>
</body>
@endsection
