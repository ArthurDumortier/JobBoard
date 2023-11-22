<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.menu') {{--  ajoute la sous page s'appelant head --}}
    <title>@yield('nomtitre')</title>
</head>

<body>
    <div class="block">
        
        @include('layout.connectionHeader')
        <div class="main">
        @yield('monbody') {{-- Crée d'un champs permettant d'être modifié dans la page qui appelle ce champs --}}
    </div>
    @include('layout.footer') {{--  ajoute la sous page s'appelant footer --}}
    </div>
</body>

</html>