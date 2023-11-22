@extends('layout.administrateurMaster')

@section('nomtitre')
Accueil Administrateur partie Annonce
@endsection

@section('monbody')
<div class="container-all">
    <h1 class="admin-page-title">Liste des annonces</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Entreprise</th>
                <th scope="col">Type de contrat</th>
                <th scope="col">Salaire minimum</th>
                <th scope="col">Salaire Maximum</th>
                <th scope="col">Création date</th>
                <th scope="col">Durée</th>
                <th scope="col">Adresse</th>
                <th scope="col">Ville</th>
                <th scope="col">Code postal</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Date de début</th>
                <th scope="col">Date de fin</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody class="container-description">
        </tbody>
    </table>
</div>

<script src="{{ asset('js/adminAnnonce.js') }}"></script>

<!-- <script defer>

</script> -->

@endsection