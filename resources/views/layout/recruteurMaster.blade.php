<!DOCTYPE html>
<html lang="en">
<head>
   @include('layout.menuUtilisateur')
   <title>@yield('nomtitre')</title>
   <link rel="stylesheet" href="{{asset('css/recruteur.css')}}">
</head>
<body data-user-id="{{session()->get('user')->id}}" data-user-role="{{session()->get('user')->roleId}}">
    <div class="block">
        @include('layout.headerRecruteur')
        @yield('monbody')
    @include('layout.footer')
</div>
</body>
</html>