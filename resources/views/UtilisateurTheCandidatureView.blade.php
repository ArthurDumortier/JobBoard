@extends('layout.utilisateurMaster')

@section('nomtitre')
L'annonce
@endsection

@section('monbody')
<div class="container">
    Candidature en attente
    <br>
    Vert : Candidature acceptée
    <br>
    Rouge : Candidature refusée
    <div class="row">
        <div class="col-md-12">
            <h1>Vos Candidatures</h1>
            <table class="tableCandidature">
                <thead>
                    <tr>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type de Contrat</th>
                        <th scope="col">Statut</th>
                        <th scope="col">CV</th>
                        <th scope="col">Lettre de Motivation</th>     
                        <th scope="col">Date de Postulage</th>                  
                    </tr>
                </thead>
                <tbody class="candidature">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{asset('js/theCandidatureScript.js')}}"></script>
@endsection