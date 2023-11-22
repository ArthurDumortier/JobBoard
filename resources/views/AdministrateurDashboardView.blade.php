@extends('layout.administrateurMaster')

@section('nomtitre')
Accueil Administrateur
@endsection

@section('monbody')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Accueil Administrateur</h1>
            <p>Bienvenue {{session()->get('user')->firstName}} {{session()->get('user')->lastName}} !</p>
        </div>
    </div>
</div>
@endsection