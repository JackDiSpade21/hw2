<html>
<head>
    <title>Accedi | Ticketmaster</title>
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles/auth.css') }}">
    <script src="{{ url('scripts/footer.js') }}" defer></script>
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
        <form name="login" method="post">
            @csrf
            <h2>Login</h2>
            <p class="margin-bottom">Non ancora registrato?&nbsp;
                <a href="{{ url('register') }}">Registrati</a>
            </p>
            <div class="input-container">
                <div class="input-grouped">
                    <div class="input-field">
                        <label for="email">Email</label>
                        <input id="email" name="email" required="required" value="{{ old('email') }}" type="email">
                    </div>
                    <div class="input-field">
                        <label for="password">Password&nbsp;
                            <a class="recovery" href="#">Recupera</a>
                        </label>
                        <input id="password" name="password" required="required" value="" type="password">
                    </div>
                </div>                 
                <label class="margin-bottom">
                    <input type="checkbox" name="ricordami" value="ricordami"/>
                    Ricordami
                </label>
                <input class="button-submit margin-bottom-double" value="Accedi" name="submit_btn" type="submit">
            </div>
        </form>
    </section>

    @include('blocks.bottom')
</body>
</html>