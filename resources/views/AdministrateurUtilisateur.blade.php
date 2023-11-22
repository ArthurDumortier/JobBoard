@extends('layout.administrateurMaster')

@section('nomtitre')
Accueil Administrateur partie Utilisateur
@endsection

@section('monbody')

<div class="container-all">
    <h1 class="admin-page-title">Liste des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom de l'utilisateur</th>
                <th scope="col">Date de création du compte</th>
                <th scope="col">Role</th>
                <th scope="col">Email</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Code postal</th>
                <th scope="col">Ville</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Est actif</th>
                <th scope="col">Pays</th>
                <th scope="col">Entreprise</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody class="container-description">
        </tbody>
    </table>
    <a href="{{route('CreateUser', ['id' => session()->get('user')->id])}}"><button class="buttonInscription">Crée un utilisateur</button></a>

</div>

<script src="{{ asset('js/adminUser.js') }}"></script>

@endsection