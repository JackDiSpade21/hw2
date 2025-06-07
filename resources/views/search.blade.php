<!DOCTYPE html>
<html>
<head>
    <title>Ticketmaster | Trova gli Eventi</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/search.css') }}">
    <script src="{{ url('scripts/footer.js') }}" defer></script>
    <script src="{{ url('scripts/nav.js') }}" defer></script>
    <script src="{{ url('scripts/menu.js') }}" defer></script>
    <script src="{{ url('scripts/search.js') }}" defer></script>
    <script>
        BASE_URL = "{{ url('/') }}";
    </script>
    <link rel="stylesheet" type="text/css" href="{{ url('styles/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/footer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    @include('blocks.topnosearch')
    @include('blocks.mobiletop')

    <div id="search-box">
        <form id="search-form">
            <input type="text" name="searchInput" placeholder="Artista, Evento o Località">
            <button type="submit" id="search-button">
                <img class="search-icon" src="{{ url('icons/searchblue.png') }}">
            </button>
        </form>
    </div>

    <section id="main">
        <div id="event-container">
            <div id="event-box">
                <div class="event-count">
                    <h2>Risultati della ricerca</h2>
                </div>
                <div id="event-list">
                    
                </div>
                <a id="load-more" class="hide">
                    <p>Carica altro</p>
                </a>
            </div>
        </div>
    </section>

    @include('blocks.bottom')
</body>
</html>