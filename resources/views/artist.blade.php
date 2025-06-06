<!DOCTYPE html>
<html>
<head>
    <title>Biglietti per {{ $artista->Nome }} | Ticketmaster</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/eventpage.css') }}">
    <script>
        const BASE_URL = "{{ url('/') }}";
    </script>
    <script src="{{ url('scripts/nav.js') }}" defer></script>
    <script src="{{ url('scripts/footer.js') }}" defer></script>
    <script src="{{ url('scripts/artistpage.js') }}" defer></script>
    <script src="{{ url('scripts/spotifybox.js') }}" defer></script>
    <script src="{{ url('scripts/menu.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ url('styles/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/footer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    <div id="spotifybox" class="spotifybox-style hidden">
        <div id="spotify-close">
            <div id="close-button-spotify"><img src="{{ url('icons/cross.png') }}"></div>
        </div>

        <img id="spotify-pic" src="{{ url('icons/person.png') }}">
        <h2 id="spotify-title">Brani popolari di <br></h2>

        <div id="spotify-songs"></div>
    </div>

    @include('blocks.top')
    @include('blocks.mobiletop')

    <section id="hero">
        <div id="heroblur" style="background-image: url('{{ $artista->Img }}');"></div>
        <div id="description" class="width-limiter des-box">
            <div id="link-path">
                <a href="#">Pagina iniziale</a>
                <span>&nbsp;/&nbsp;</span>
                <a href="#">{{ $artista->Categoria }}</a>
                <span>&nbsp;/&nbsp;</span>
                <a href="#">{{ $artista->Genere }}</a>
                <span>&nbsp;/&nbsp;</span>
                <span>{{ $artista->Nome }} Biglietti</span>
            </div>
            <div id="hero-des">
                <p>{{ $artista->Genere }}</p>
                <h1>Biglietti per {{ $artista->Nome }}</h1>
            </div>
        </div>       
    </section>

    <nav id="event-nav">
        <div class="width-limiter">
            <div id="navigation-event">
                <div id="biglietti-evento" class="event-nav-active event-nav-hover">Eventi</div>
                <div id="info-evento" class="nav-button event-nav-hover">Informazioni</div>
                <div id="scalette" class="nav-button event-nav-hover">Scaletta</div>
                <div id="faq" class="nav-button event-nav-hover">Faq</div>
            </div>
        </div>
    </nav>

    <section id="main" data-id="{{ $artista->ID }}">
        <div id="event-container">
            <div class="width-limiter">
                <div class="section-title">
                    <p></p>
                    <h2>Eventi</h2>
                </div>
                <div id="event-box">
                    <div class="event-count">
                        <h2><strong id="eventi-futuri">0</strong> Eventi futuri</h2>
                    </div>
                </div>
            </div>
        </div>

        <div id="info-container">
            <div class="width-limiter">
                <div id="info-box">
                    <div class="section-title">
                        <p></p>
                        <h2>Informazioni</h2>
                    </div>
                    <p>
                        <strong>Tutto su {{ $artista->Nome }}!</strong>
                        <br><br>
                        {!! $artista->Descrizione !!}

                        @if($artista->Categoria === 'Musica')
                            <a class="spotify-button" data-id="{{ $artista->ID }}" data-name="{{ $artista->Nome }}">
                                <span>Spotify</span>
                                <img src="{{ url('icons/arrowblack.png') }}">
                            </a>
                        @endif
                    </p>
                </div>
            </div>
            <div class="white-filler"></div>
            <img class="back-image" src="{{ $artista->Img }}">
        </div>

        <div id="scaletta-container">
            <div class="width-limiter">
                <div class="section-title">
                    <p></p>
                    <h2>Scaletta</h2>
                </div>
                <br>
                @foreach($scaletta as $id => $sc)
                    <strong>{{ $sc['Nome'] }}</strong>
                    <ol>
                        @foreach($sc['canzoni'] as $canzone)
                            <li>{{ $canzone->Nome }}</li>
                        @endforeach
                    </ol>
                @endforeach
            </div>
        </div>

        <div id="faq-container">
            <div class="width-limiter">
                <div class="section-title">
                    <p></p>
                    <h2>FAQ</h2>
                </div>

                <div id="collegamenti-faq">

                    <div id="divider-faq"><div></div></div>

                    <div class="elenco-faq" data-cat="domanda1">
                        <h3>Come si descrive in breve {{ $artista->Nome }}?</h3>
                        <img class="faq-arrow" src="{{ url('icons/downarrowblack.png') }}">
                    </div>

                    <div class="faqlist hidden" data-cat="domanda1">                   
                        <p>{{ $artista->Hero }}</p>
                    </div>

                    <div id="divider-faq"><div></div></div>

                    <div class="elenco-faq" data-cat="domanda2">
                        <h3>I biglietti per l'evento di {{ $artista->Nome }} sono nominativi?</h3>
                        <img class="faq-arrow" src="{{ url('icons/downarrowblack.png') }}">
                    </div>

                    <div class="faqlist hidden" data-cat="domanda2">                   
                        <p>I biglietti non sono nominativi, ma è necessario un account Ticketmaster per acquistarli.</p>
                    </div>

                    <div id="divider-faq"><div></div></div>

                    <div class="elenco-faq" data-cat="domanda3">
                        <h3>Come posso ottenere un rimborso per un biglietto di {{ $artista->Nome }}?</h3>
                        <img class="faq-arrow" src="{{ url('icons/downarrowblack.png') }}">
                    </div>

                    <div class="faqlist hidden" data-cat="domanda3">                   
                        <p>Per richiedere il rimborso per un biglietto consulta le <a class="faq-link" href="#">FAQ sui rimborsi.</a></p>
                    </div>

                    <div id="divider-faq"><div></div></div>

                    <div class="elenco-faq" data-cat="domanda4">
                        <h3>Come posso rivendere un biglietto di {{ $artista->Nome }}?</h3>
                        <img class="faq-arrow" src="{{ url('icons/downarrowblack.png') }}">
                    </div>

                    <div class="faqlist hidden" data-cat="domanda4">                   
                        <p>Per rivendere un biglietto di {{ $artista->Nome }} consulta le <a class="faq-link" href="#">FAQ sulla rivendita dei biglietti.</a></p>
                    </div>

                    <div id="divider-faq"><div></div></div>
                
                </div>
            </div>
        </div>
    </section>

    @include('blocks.bottom')
</body>
</html>