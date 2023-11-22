    <header>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-5">
                    <a href="{{route('UtilisateurDashboard', ['id' => session()->get('user')->id])}}"><img src="{{asset('logo.png')}}"
                            alt="Logo" width="80" height="auto"></a>
                </div>
                <nav class="col-md-7">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a href="{{route('ProfilUser', ['id' => session()->get('user')->id])}}"
                                class="nav-link buttonInscription">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('CandidatureUser', ['id' => session()->get('user')->id])}}" class="nav-link buttonInscription">Mes
                                Candidatures</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" id="messageView" class="nav-link buttonInscription">Messages</a>
                        </li> --}}
                        <li class="nav-item">
                            @include('layout.logout')
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
</header>