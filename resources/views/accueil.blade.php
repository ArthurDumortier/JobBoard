@extends('layout.master')

@section('nomtitre')
Job Board
@endsection

@section('monbody')
<div>
    <h1>Annonces</h1>
    <h1>Utilisateurs</h1>
    <div class="container-description">

    </div>
</div>

<!-- <script defer>
    let container = document.querySelector('.container-description');
    console.log(container);
    fetch('http://127.0.0.1:8000/api/annonces')
    .then(response => response.json())
    .then(data => {
        data.forEach(value => {
            console.log(value);
           let titre = document.createElement("h2");
           titre.textContent = value.titre;
           console.log(titre);
           container.appendChild(titre);
        });
    })
</script> -->
@endsection