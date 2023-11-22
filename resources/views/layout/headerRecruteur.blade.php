<header>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-5">
                <a href="{{route('RecruteurDashboard', ['id' => session()->get('user')->id])}}"><img src="{{asset('logo.png')}}"
                        alt="Logo" width="80" height="auto"></a>
            </div>
            <nav class="col-md-7">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="{{route('RecruteurProfil', ['id' => session()->get('user')->id])}}"
                            class="nav-link buttonInscription">Profil</a>
                    </li>
                    <li class="nav-item">
                        <span id="entreprise"></span>
                        {{-- @if(session()->get('user')->idEntreprise)
                        <a href="{{route('EntrepriseInfo', ['id' => session()->get('user')->idEntreprise])}}"
                            class="nav-link buttonInscription">Voir info entreprise</a>
                        @else
                        <a href="{{route('ChooseCorporate', ['id' => session()->get('user')->id])}}"  class="nav-link buttonInscription">
                            Rejoindre une entreprise </a>
                        @endif --}}
                    </li>
                    <li class="nav-item">
                        @include('layout.logout')
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>