    <header>
        <div class="d-flex flex-column align-items-center p-3 px-md-4 mb-3">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-5">
                        <a href="{{url('/')}}"><img src="{{asset('logo.png')}}" alt="Logo" width="80" height="auto"></a>
                    </div>
                    <nav class="col-md-7">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a href="{{route('Inscription')}}" class="nav-link buttonInscription">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('Connection')}}" class="nav-link buttonInscription">Se Connecter</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
