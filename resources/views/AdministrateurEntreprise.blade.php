@extends('layout.administrateurMaster')

@section('nomtitre')
Accueil Administrateur partie Entreprise
@endsection

@section('monbody')

<div class="container-all">
    <h1 class="admin-page-title">Liste des entreprises</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom de l'entreprise</th>
                <th scope="col">Description</th>
                <th scope="col">Siege social</th>
                <th scope="col">Nombre de salariés</th>
                <th scope="col">Date de création</th>     
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>   
            </tr>
        </thead>
        <tbody class="container-description">
        </tbody>
    </table>
</div>
<script src="{{ asset('js/adminEntreprise.js') }}"></script>
@endsection