@extends('layout.utilisateurMaster')

@section('nomtitre')
Vos Candidatures
@endsection

@section('monbody')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Vos Candidatures</h1>
            <table class="tableCandidature">
                <thead>
                    <tr>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Type de Contrat</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="candidatures">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('js/candidatureScript.js') }}"></script>
@endsection
