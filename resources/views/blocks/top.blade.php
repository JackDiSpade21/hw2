<header>
    <div id="languages">
        <img id="flag" src="{{ url('icons/italy.png') }}"></img>
        <a href="#">IT</a>
        <img src="{{ url('icons/lang.png') }}"></img>
        <a href="#">IT</a>
    </div>
    <div id="info">
        <a href="#">Blog</a>
        <a href="#">Newsletter</a>
        <a href="#">B2B</a>
        <a href="#">FAQ</a>
        <div id="paypal"></div>
    </div>
</header>
<nav>
    <div id="left-navbar">
        <div id="mobile-menu">
            <img src="{{ url('icons/menu.png') }}">
        </div>
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ url('icons/logo.png') }}">
        </a>
        <div id="navigation">
            <div id="Musica" class="nav-button nav-b-hover">Musica</div>
            <div id="Festival" class="nav-button nav-b-hover">Festival</div>
            <div id="Arte" class="nav-button nav-b-hover">Arte & Teatro</div>
            <div id="Sport" class="nav-button nav-b-hover">Sport</div>
            <div id="Tempo" class="nav-button nav-b-hover">Tempo libero</div>
            <div id="Altro" class="nav-button nav-b-hover">Altro</div>
        </div>
    </div>
    <div id="functions">
        <form id="webbar" class="searchbar" action="{{ url('search') }}" method="get">
            <input type="text" name="search" placeholder="Artista, Evento o Località">
            <button type="submit" id="sbutton"><img id="search" src="{{ url('icons/search.png') }}"></button>
        </form>
        <a id="login" href="{{ session('Mail') ? url('profile') : url('login') }}">
            <img id="person" src="{{ url('icons/person.png') }}">
            <p>
                @if(session('Mail'))
                    {{ strlen(session('Nome')) > 14 ? substr(session('Nome'), 0, 14) . '..' : session('Nome') }}
                @else
                    Accedi/Registrati
                @endif
            </p>
        </a>
    </div>

    <div id="modal-nav-desktop" class="hidden">
        <div id="nav-sidebar" class="hidden">
            <div id="other-music" class="other-navigation other-buttons">
                <p>Musica</p>
                <img src="{{ url('icons/freccia.png') }}">
            </div>
            <div id="other-festival" class="other-navigation other-buttons">
                <p>Festival</p>
                <img src="{{ url('icons/freccia.png') }}">
            </div>
            <div id="other-art" class="other-navigation other-buttons">
                <p>Arte & Teatro</p>
                <img src="{{ url('icons/freccia.png') }}">
            </div>
            <div id="other-sport" class="other-navigation other-buttons">
                <p>Sport</p>
                <img src="{{ url('icons/freccia.png') }}">
            </div>
            <div id="other-tempo" class="other-navigation other-buttons other-active">
                <p>Tempo Libero</p>
                <img src="{{ url('icons/freccia.png') }}">
            </div>
        </div>

        <div id="nav-box-wrapper">
            
        </div>
    </div>
</nav>

<div id="barwrapper">
    <form id="mobilebar" class="searchbar" action="{{ url('search') }}" method="get">
        <input type="text" name="search" placeholder="Artista, Evento o Località">
        <button type="submit" id="sbutton"><img id="search" src="{{ url('icons/search.png') }}"></button>
    </form>
</div>