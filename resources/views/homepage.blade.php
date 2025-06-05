<html>
<head>
    <title>Ticketmaster | Biglietti Ufficiali per Concerti, Festival, Arte e Teatro</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/homepage.css') }}">
    <script src="{{ url('scripts/nav.js') }}" defer></script>
    <script src="{{ url('scripts/footer.js') }}" defer></script>
    <script src="{{ url('scripts/menu.js') }}" defer></script>
    <script src="{{ url('scripts/homepage.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ url('styles/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/footer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    
    @include('blocks.top')

    <section id="hero">
        <div id="heroblur"></div>   
        <div id="description">
            <h3></h3>
            <p></p>
            <a>Biglietti</a>
        </div>       
    </section>

    @include('blocks.mobiletop')

    <section id="main">
        <div id="content">

            <div id="main-cards">

            </div>

            <div id="featured">
                <div id="scroll-arrow" class="sc-feat-right"></div>
                <h1>Biglietti più richiesti</h1>
                <div id="most-wanted">
                    
                </div>
            </div>

            <div id="scopri">
                <div id="scroll-arrow" class="sc-dis-right"></div>
                <h1>Scopri</h1>
                <div id="discover">
                    
                </div>
            </div>

        </div>
        <div id="side">
            <h1>consigliati</h1>
            <div id="sidebar">                
                <a class="card sidebar" href="#">
                    <div id="holder">
                        <img class="big-card" src="{{ url('cards/BigliettiVipmedium2.webp') }}"></img>
                        <div class="overlay">
                            <div class="tsov"></div>
                            <div class="solidov"><img src="{{ url('icons/freccia.png') }}"></img></div>
                        </div>
                    </div>
                    <h3>Biglietti VIP</h3>
                </a>
                <a href="#" class="card sidebar">
                    <div id="holder">
                        <img class="big-card" src="{{ url('cards/RapMaster2023_medium.webp') }}"></img>
                        <div class="overlay">
                            <div class="tsov"></div>
                            <div class="solidov"><img src="{{ url('icons/freccia.png') }}"></img></div>
                        </div>
                    </div>
                    <h3>RapMaster</h3>
                </a>
                <a href="#" class="card sidebar">
                    <div id="holder">
                        <img class="big-card" src="{{ url('cards/PopMaster2023_medium.webp') }}"></img>
                        <div class="overlay">
                            <div class="tsov"></div>
                            <div class="solidov"><img src="{{ url('icons/freccia.png') }}"></img></div>
                        </div>
                    </div>
                    <h3>Popmaster</h3>
                </a>
                <a href="#" class="card sidebar">
                    <div id="holder">
                        <img class="big-card" src="{{ url('cards/IndieMaster2023_medium.webp') }}"></img>
                        <div class="overlay">
                            <div class="tsov"></div>
                            <div class="solidov"><img src="{{ url('icons/freccia.png') }}"></img></div>
                        </div>
                    </div>
                    <h3>Indiemaster</h3>
                </a>
            </div>
        </div>
    </section>

    @include('blocks.bottom')

</body>
</html>