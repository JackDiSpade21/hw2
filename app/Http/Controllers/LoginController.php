<?php
namespace App\Http\Controllers;
use App\Models\Utente;

class LoginController extends Controller
{
    public function register_form()
    {
        if(session('Mail')) {
            return redirect('/');
        }
        return view('register');
    }

    public function login_form()
    {
        if(session('Mail')) {
            return redirect('/');
        }
        return view('login');
    }

    public function get_homepage()
    {
        $nome = session('Nome', null);
        return view('homepage')
            ->with('nome', $nome);
    }

    public function get_profile()
    {
        if(!session('Mail')) {
            return redirect('/login');
        }

        $utente = Utente::where('Mail', session('Mail'))->first();

        return view('profile')
            ->with('utente', $utente)
            ->with('firstLogin', request()->query('firstLogin', false))
            ->with('buy', request()->query('buy', 0));
    }

    public function do_register(\Illuminate\Http\Request $request)
    {

        if(session('Mail')) {
            return redirect('/');
        }

        $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:Utente,Mail',
            ],
            'confirmEmail' => [
                'required',
                'same:email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,32}$/',
            ],
            'confirmPassword' => [
                'required',
                'same:password',
            ],
            'numberPrefix' => [
                'required',
                'in:+39,+1,+44,+49,+33,+34',
            ],
            'number' => [
                'required',
                'digits_between:9,20',
                'regex:/^[0-9]{9,20}$/',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'surname' => [
                'required',
                'string',
                'max:255',
            ],
            'birth' => [
                'required',
                'date',
                //funzione anonima, closure, $fail è una funzione che viene chiamata se la validazione fallisce
                // \ per chiamare le classi di PHP native
                function ($attribute, $value, $fail) {
                    $birthDate = \DateTime::createFromFormat('Y-m-d', $value);
                    $today = new \DateTime();
                    if ($birthDate) {
                        $age = $today->diff($birthDate)->y;
                        if ($age < 18) {
                            $fail("Devi avere almeno 18 anni per registrarti");
                        } elseif ($age > 100) {
                            $fail("Data di nascita non valida");
                        }
                    } else {
                        $fail("Data di nascita non valida");
                    }
                }
            ],
            'birthPlace' => [
                'nullable',
                'string',
                'max:255',
            ],
            'privacy' => [
                'required',
                'in:agreePrivacy',
            ],
            'terms' => [
                'required',
                'in:agreeTerms',
            ],
        ], [
            'required' => 'Compila correttamente tutti i campi obbligatori.',
            'email.unique' => "L'email inserita è già in uso.",
            'confirmEmail.same' => "Le email non corrispondono",
            'password.regex' => "La password deve rispettare i requisiti indicati.",
            'confirmPassword.same' => "Le password non corrispondono",
            'privacy.in' => "Devi accettare l'informativa sulla privacy",
            'terms.in' => "Devi accettare i termini e le condizioni",
            'numberPrefix.in' => "Prefisso non valido",
            'number.digits_between' => "Numero di telefono non valido",
            'number.regex' => "Il numero di telefono deve contenere solo cifre",
        ]);

        $user = new Utente();
        $user->Mail = request('email');
        $user->Psw = password_hash(request('password'), PASSWORD_BCRYPT);
        $user->Nome = request('name');
        $user->Cognome = request('surname');
        $user->Tel = request('numberPrefix') . request('number');
        $user->Nascita = request('birth');
        $user->Luogo = request('birthPlace');
        $user->Newsletter = request('newsletter') ? 1 : 0;
        $user->save();

        session(['Mail' => $user->Mail, 'Nome' => $user->Nome]);
        return view('profile')
            ->with('utente', $user)
            ->with('firstLogin', true)
            ->with('buy', 0);
    }

    public function do_login(\Illuminate\Http\Request $request)
    {
        if(session('Mail')) {
            return redirect('/');
        }

        $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ], [
            'required' => 'Compila correttamente tutti i campi obbligatori.',
        ]);

        $user = Utente::where('Mail', request('email'))->first();

        if (!$user || !password_verify(request('password'), $user->Psw)) {
            return back()->withErrors(['email' => "Email o password errati."]);
        }

        session(['Mail' => $user->Mail, 'Nome' => $user->Nome]);
        return redirect('/');
    }
}
