<header>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-5">
                <a href="{{route('AdministrationDashboard', ['id' => session()->get('user')->id])}}"><img src="{{asset('logo.png')}}"
                        alt="Logo" width="80" height="auto"></a>
            </div>
            <nav class="col-md-7">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="{{route('AdministrateurProfil', ['id' => session()->get('user')->id])}}"
                            class="nav-link buttonInscription">Profil Administrateur</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('AdministrateurUser', ['id' => session()->get('user')->id])}}" class="nav-link buttonInscription">Gérer Utilisateur</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('AdministrateurAnnonce', ['id' => session()->get('user')->id])}}" class="nav-link buttonInscription">Gérer Annonces</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('AdministrateurEntreprise', ['id' => session()->get('user')->id])}}" class="nav-link buttonInscription">Gérer Entreprises</a>
                    </li>
                    <li class="nav-item">
                        @include('layout.logout')
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>