<html>
<head>
    <title>Il mio profilo | Ticketmaster</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/eventpage.css') }}">
    <script>
        const BASE_URL = "{{ url('/') }}";
    </script>
    <script src="{{ url('scripts/footer.js') }}" defer></script>
    <script src="{{ url('scripts/profile.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ url('styles/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/footer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    @include('blocks.topslim')

    <section class="profilehero">
        <div id="heroblur" class="profilepic"></div>   
        <div id="description" class="width-limiter des-box">
            <div id="link-path">
            </div>
            <div id="hero-des">
                <p>Area Personale di</p>
                <h1>{{ $utente['Nome'] }} {{ $utente['Cognome'] }}</h1>
            </div>
        </div>       
    </section>

    <nav id="event-nav">
        <div class="width-limiter">
            <div id="navigation-event">
                <div id="dati-personali" class="event-nav-active event-nav-hover">I miei dati</div>
                <div id="biglietti" class="nav-button event-nav-hover">Biglietti</div>
            </div>
        </div>
    </nav>

    <section id="main">
        <div id="event-container">
            <div class="width-limiter">
                <div id="my-tickets" class="hidden">
                    <div class="section-title">
                        <p></p>
                        <h2>I tuoi biglietti</h2>
                    </div>
                    <div id="event-box">
                        <div class="event-count">
                            <h2>Elenco dei biglietti posseduti</h2>
                        </div>
                        <div id="event-list">

                        </div>
                        <a id="load-more">
                            <p>Carica altro</p>
                        </a>
                    </div>
                </div>

                <div id="my-data" class="">
                    <h4 class="@if($firstLogin) welcome @else hidden @endif">
                        Benvenuto su TicketMaster!<br>Questa è la area personale, potrai
                        vedere i tuoi biglietti acquistati quì.<br>Torna alla home per vedere gli eventi!
                    </h4>

                    <h4 class="@if($buy == 1) welcome @else hidden @endif">
                        L'acquisto è andato a buon fine!<br>Visualizza i tuoi biglietti
                        nella sezione "BIGLIETTI"!.
                    </h4>

                    <h4 class="@if($buy == 2) error @else hidden @endif">
                        Errore durante l'emissione dei biglietti.<br>
                        Nessun biglietto è stato emesso.<br> Riprova più tardi.
                    </h4>

                    <div class="section-title margin-bottom-double">
                        <p></p>
                        <h2>I tuoi dati personali</h2>
                    </div>

                    <div class="input-grouped margin-bottom-double">
                        <div class="input-field">
                            <h2>Nome</h2>
                            <p>{{ $utente['Nome'] }}</p>
                        </div>
                        <div class="input-field">
                            <h2>Cognome</h2>
                            <p>{{ $utente['Cognome'] }}</p>
                        </div>
                    </div>

                    <div class="input-grouped margin-bottom-double">
                        <div class="input-field">
                            <h2>Email</h2>
                            <p>{{ $utente['Mail'] }}</p>
                        </div>
                        <div class="input-field">
                            <h2>Telefono</h2>
                            <p>{{ $utente['Tel'] }}</p>
                        </div>
                    </div>

                    <div class="input-grouped margin-bottom-double">
                        <div class="input-field">
                            <h2>Data di nascita</h2>
                            <p>{{ $utente['Nascita'] }}</p>
                        </div>
                        <div class="input-field">
                            <h2>Luogo di nascita</h2>
                            <p>
                                @if($utente['Luogo'] == 0)
                                    Non fornito
                                @else
                                    {{ $utente['Luogo'] }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <a class="button-submit margin-bottom" href="{{ url('logout') }}">Logout</a>
                
                </div>

            </div>
        </div>
    </section>

    @include('blocks.bottom')
</body>
</html>