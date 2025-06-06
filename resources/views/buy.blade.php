<!DOCTYPE html>
<html>
<head>
    <title>Acquista biglietti per {{ $artista['Nome'] }} | Ticketmaster</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/buy.css') }}">
    <script>
        const BASE_URL = "{{ url('/') }}";
    </script>
    <link rel="stylesheet" type="text/css" href="{{ url('styles/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/footer.css') }}">
    <script src="{{ url('scripts/footer.js') }}" defer></script>
    <script src="{{ url('scripts/buy.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    @include('blocks.topslim')

    <section id="main">
    <div class="width-limiter">
        <form name="buy" method="post">
            @csrf
            <div id="concert-recap">
                <img src="{{ $artista['Img'] }}" class="event-image">
                <div>
                    <h3 class="margin-bottom event-title">{{ $evento['Nome'] }}</h3>
                    <label class="margin-bottom">{{ $evento['DataEvento'] }} - h {{ substr($evento['Ora'], 0, -3) }} | {{ $evento['Luogo'] }}</label>
                    <label class="margin-bottom">Artista: {{ $artista['Nome'] }}</label>
                </div>
            </div>
            
            <div id="step1" class="input-container">

                <div id="ticketdisclaimer">
                    Si esercita un limite di 5 biglietti per singolo ordine.
                    Biglietti rimasti: {{ $postiRimasti['Rimasti'] }}.
                </div>
                <b class="section-title">tipologia di biglietto</b>
                
                @foreach($posti as $posto)
                    <div class="divider-buy"></div>
                    <div class="input-grouped input-go-column">
                        <h3 class="ticket-type">{{ $posto['Nome'] }} / {{ $posto['Des'] }}</h3>
                        <div class="quantity-field">
                            @if($posto['Capacita'] > 0)
                                <input type="number" id="quantity_{{ $posto['ID'] }}" name="quantity_{{ $posto['ID'] }}" min="0" max="{{ min(5, $posto['Capacita']) }}" value="0">
                            @else
                                <p class="oos">esaurito</p>
                            @endif
                            <p class="tick-quantity" for="quantity_{{ $posto['ID'] }}">{{ number_format($posto['Costo'], 2, ',', '.') }} €</p>
                        </div>
                    </div>
                @endforeach
                <div class="divider-buy"></div>

                <b class="section-title">Modalità di consegna</b>
                <div class="divider-buy"></div>

                <div class="margin-bottom-double">
                    <label>
                        <input required type="radio" name="print" value="pay" {{ old('print') === 'pay' ? 'checked' : '' }}/>
                        <div class="ticket-mode">
                            <p>Spedizione tramite corriere espresso.</p>
                            <p class="print-price">10,00 €</p>
                        </div>
                    </label>
                    <div class="divider-buy"></div>
                    <label>
                        <input required type="radio" name="print" value="free" {{ old('print', 'free') === 'free' ? 'checked' : '' }}/>
                        <div class="ticket-mode">
                            <p>Stampa a casa, ricevi via mail.</p>
                            <p class="print-price">Gratis</p>
                        </div>
                    </label>
                    <div class="divider-buy"></div>
                </div>
            </div>

            <div id="step2" class="input-container">

                <b class="section-title">Dati di fatturazione</b>
                
                <div class="divider-buy margin-bottom-double"></div>
                <div class="input-grouped margin-bottom">
                    <div class="input-field">
                        <label>Nome *</label>
                        <input name="name" required value="{{ old('name') }}" type="text">
                    </div>
                    <div class="input-field">
                        <label for="surname">Cognome *</label>
                        <input name="surname" required value="{{ old('surname') }}" type="text">
                    </div>
                </div>

                <div class="input-grouped margin-bottom">
                    <div class="input-field">
                        <label for="address">Indirizzo completo *</label>
                        <input name="address" required value="{{ old('address') }}" type="text">
                    </div>
                    <div class="input-field">
                        <label for="cap">CAP *</label>
                        <input name="cap" required value="{{ old('cap') }}" type="text">
                    </div>
                </div>

                <div class="input-grouped margin-bottom">
                    <div class="input-field">
                        <label for="city">Provincia *</label>
                        <input name="city" required value="{{ old('city') }}" type="text">
                    </div>
                </div>

                <b class="section-title">Dati di pagamento</b>
                <div class="divider-buy margin-bottom-double"></div>
                <div class="input-grouped margin-bottom">
                    <div class="input-field">
                        <label for="card">Numero di carta *</label>
                        <input name="card" required value="{{ old('card') }}" type="text" maxlength="16">
                    </div>
                    <div class="input-field">
                        <label for="cvc">CVC *</label>
                        <input id="cvc" name="cvc" required value="" type="text" maxlength="3">
                    </div>
                </div>

                <div class="input-grouped">
                    <div class="input-field">
                        <label>Data di scadenza (MM/AA) *</label>
                        <input name="expiry" required value="{{ old('expiry') }}" type="text" maxlength="5">
                    </div>
                </div>

                <b class="section-title">Finalizzazione</b>
                <div class="divider-buy margin-bottom"></div>
                <h2 class="margin-bottom">0.00 €</h2>
                <h3 class="margin-bottom">
                    I biglietti saranno connessi al profilo di <strong>{{ $utente['Nome'] }} {{ $utente['Cognome'] }}</strong>.
                </h3>
                <label>Sono incluse le tasse. Verrà inviata una ricevuta via mail.</label>
                <label class="margin-bottom-double">I biglietti saranno visibili sul tuo profilo.</label>

                <div class="submit-wrapper">
                    <p id="error" class="error{{ !empty($errors) ? '' : ' hidden' }}">
                        @foreach ($errors as $err)
                            {{ $err }}<br>
                        @endforeach
                    </p>
                    <input class="button-proceed margin-bottom-double" value="Completa acquisto" name="submit_btn" type="submit">
                </div>
            </div>

        </form>
    </div>
    </section>

    @include('blocks.bottom')
</body>
</html>