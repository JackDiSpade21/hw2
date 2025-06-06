<html>
<head>
    <title>Registrati | Ticketmaster</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/auth.css') }}">
    <script src="{{ url('scripts/footer.js') }}" defer></script>
    <script src="{{ url('scripts/auth.js') }}" defer></script>
    <script>
        const BASE_URL = "{{ url('/') }}";
    </script>
    <link rel="stylesheet" type="text/css" href="{{ url('styles/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/footer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    @include('blocks.topslim')

    <section id="main">
        <h4 id="error" class="error{{ $errors->any() ? '' : ' hidden' }}">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </h4>

        <form name="register" method="post">
            @csrf
            <h2>Sei un nuovo utente</h2>
            <p class="margin-bottom">Già registrato?&nbsp;
                <a href="{{ url('login') }}">Accedi</a>
            </p>
            <div class="input-container">
                <h4>Dati di autenticazione</h4>
                <p class="p-subtitle italic margin-bottom">Se non l'hai ancora fatto, ti ricordiamo che 
                    è necessario convalidare il tuo numero di cellulare utilizzando il codice di conferma 
                    OTP che ti verrà inviato tramite SMS
                </p>
                <div class="input-field">
                    <label>Cellulare *</label>
                    <div>
                        <select name="numberPrefix" class="number-prefix">
                            <option value="+39" {{ old('numberPrefix') === '+39' ? 'selected' : '' }}>IT +39</option>
                            <option value="+1" {{ old('numberPrefix') === '+1' ? 'selected' : '' }}>US +1</option>
                            <option value="+44" {{ old('numberPrefix') === '+44' ? 'selected' : '' }}>UK +44</option>
                            <option value="+49" {{ old('numberPrefix') === '+49' ? 'selected' : '' }}>DE +49</option>
                            <option value="+33" {{ old('numberPrefix') === '+33' ? 'selected' : '' }}>FR +33</option>
                            <option value="+34" {{ old('numberPrefix') === '+34' ? 'selected' : '' }}>ES +34</option>
                        </select>
                        <input name="number" required value="{{ old('number') }}" type="tel">
                    </div>
                </div>
                <h4>Dati di accesso</h4>
                <div class="input-grouped">
                    <div class="input-field">
                        <label for="email">Email *</label>
                        <input name="email" required value="{{ old('email') }}" type="email">
                    </div>
                    <div class="input-field">
                        <label for="confirmEmail">Conferma Email *</label>
                        <input name="confirmEmail" required value="{{ old('confirmEmail') }}" type="email">
                    </div>
                </div>
                <p class="p-subtitle italic margin-bottom">La password deve essere lunga tra 8 e 32 caratteri, deve contenere almeno 
                    una lettera maiuscola, una lettera minuscola e un numero.
                </p>
                <div class="input-grouped">
                    <div class="input-field">
                        <label for="password">Password *</label>
                        <input name="password" required value="" type="password">
                    </div>
                    <div class="input-field">
                        <label for="confirmPassword">Conferma Password *</label>
                        <input name="confirmPassword" required value="" type="password">
                    </div>
                </div>
                <h4>I miei dati</h4>
                <div class="input-grouped">
                    <div class="input-field">
                        <label for="name">Nome *</label>
                        <input name="name" required value="{{ old('name') }}" type="text">
                    </div>
                    <div class="input-field">
                        <label for="surname">Cognome *</label>
                        <input name="surname" required value="{{ old('surname') }}" type="text">
                    </div>
                </div>
                <div class="input-grouped">
                    <div class="input-field">
                        <label for="birth">Data di nascita *</label>
                        <input name="birth" required value="{{ old('birth') }}" type="date">
                    </div>
                    <div class="input-field">
                        <label for="birthPlace">Luogo di nascita</label>
                        <input name="birthPlace" value="{{ old('birthPlace') }}" type="text">
                    </div>
                </div>
                <h4 class="margin-bottom">Newsletter</h4>                  
                <label for="newsletter" class="margin-bottom">
                    <input type="checkbox" id="newsletter" name="newsletter" value="newsletter" {{ old('newsletter') ? 'checked' : '' }}/>
                    Sì, desidero rimanere aggiornato sulle ultime news dei miei 
                    eventi preferiti. Presale, promozioni, nuovi show e tanto altro! 
                    (facoltativo)
                </label>
                <h4 class="margin-bottom">Informative utente</h4>
                <p class="margin-bottom">Ho preso visione e accetto
                    <a href="#">Informativa Privacy</a> *
                </p>
                <div class="input-grouped margin-bottom-double">
                    <label>
                        <input id="checkPrivacy" required type="radio" name="privacy" value="agreePrivacy" {{ old('privacy') === 'agreePrivacy' ? 'checked' : '' }}/>
                        Acconsento
                    </label>
                    <label>
                        <input required type="radio" name="privacy" value="disagreePrivacy" {{ old('privacy') === 'disagreePrivacy' ? 'checked' : '' }}/>
                        Non acconsento
                    </label>
                </div>
                <p class="margin-bottom">Ho preso visione e accetto i
                    <a href="#">Termini e condizioni di servizio</a> *
                </p>
                <div class="input-grouped margin-bottom-double">
                    <label>
                        <input id="checkTerms" required type="radio" name="terms" value="agreeTerms" {{ old('terms') === 'agreeTerms' ? 'checked' : '' }}/>
                        Acconsento
                    </label>
                    <label>
                        <input required type="radio" name="terms" value="disagreeTerms" {{ old('terms') === 'disagreeTerms' ? 'checked' : '' }}/>
                        Non acconsento
                    </label>
                </div>
                <input class="button-submit margin-bottom-double" value="Accetta e crea" name="submit_btn" type="submit">
            </div>
        </form>
    </section>

    @include('blocks.bottom')

</body>
</html>