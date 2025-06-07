<?php
namespace App\Http\Controllers;
use App\Models\Artista;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Posto;
use App\Models\Utente;
use App\Models\Ricevuta;
use App\Models\Biglietto;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function get_artistpage($id)
    {
        $artista = Artista::where('ID', intval($id))->first();
        $nome = session('Nome', null);
        if (!$artista) {
            return redirect('/');
        }

        return view('artist')
            ->with('artista', $artista)
            ->with('scaletta', $artista->scaletta)
            ->with('nome', $nome);
    }

    public function get_buypage($id)
    {
        if (!session('Mail')) {
            return redirect('/login');
        }

        $evento = Evento::find($id);
        if (!$evento) {
            return redirect('/');
        }

        $artista = Artista::find($evento->Artista);
        $posti = Posto::where('Evento', $evento->ID)->get();
        $postiRimasti = Posto::where('Evento', $evento->ID)->sum('Capacita');
        $utente = Utente::where('Mail', session('Mail'))->first();

        return view('buy')
            ->with('artista', $artista)
            ->with('evento', $evento)
            ->with('posti', $posti)
            ->with('postiRimasti', ['Rimasti' => $postiRimasti])
            ->with('utente', $utente)
            ->with('error', []);
    }

    public function post_buypage(Request $request, $id)
    {
        if (!session('Mail')) {
            return redirect('/login');
        }

        $evento = Evento::find($id);
        if (!$evento) {
            return redirect('/');
        }

        $artista = Artista::find($evento->Artista);
        $posti = Posto::where('Evento', $evento->ID)->get();
        $postiRimasti = Posto::where('Evento', $evento->ID)->sum('Capacita');
        $utente = Utente::where('Mail', session('Mail'))->first();

        $error = [];

        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'cap' => 'required|digits:5',
            'card' => 'required|digits:16',
            'cvc' => 'required|digits:3',
            'expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'print' => 'required|in:pay,free',
        ]);
        $ticket_sum = 0;
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'quantity_') === 0) {
                $qty = intval($value);
                if ($qty < 0) $qty = 0;
                $ticket_sum += $qty;
            }
        }
        if ($ticket_sum < 1) {
            $error[] = "Seleziona almeno un biglietto.";
        }
        if ($ticket_sum > 5) {
            $error[] = "Puoi acquistare al massimo 5 biglietti per ordine.";
        }

        if (preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $request->expiry)) {
            [$mm, $yy] = explode('/', $request->expiry);
            $expMonth = intval($mm);
            $expYear = 2000 + intval($yy);
            $nowMonth = intval(date('n'));
            $nowYear = intval(date('Y'));
            if ($expYear < $nowYear || ($expYear === $nowYear && $expMonth < $nowMonth)) {
                $error[] = "La carta è scaduta.";
            }
        }

        if (count($error) > 0) {
            return back()->withInput()->with('errors', $error);
        }

        $totale = 0.0;
        $quantita = 0;
        $informazioni = "";

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'quantity_') === 0) {
                $tipo_id = intval(str_replace('quantity_', '', $key));
                $qty = intval($value);
                if ($qty > 0) {
                    $posto = Posto::find($tipo_id);
                    if ($posto) {
                        $totale += $posto->Costo * $qty;
                        $informazioni .= "Biglietto: " . e($posto->Nome) . " x" . $qty . "<br>";
                        $quantita += $qty;
                    }
                }
            }
        }

        if ($request->print === 'pay') {
            $totale += 10.00;
            $informazioni .= "Spedizione: Corriere espresso<br>";
        } else {
            $informazioni .= "Spedizione: Stampa a casa<br>";
        }

        $fields_to_save = [
            'name' => 'Nome',
            'surname' => 'Cognome',
            'address' => 'Indirizzo',
            'cap' => 'CAP',
            'city' => 'Provincia',
            'card' => 'Numero carta',
            'expiry' => 'Scadenza carta'
        ];
        foreach ($fields_to_save as $field => $label) {
            if ($request->has($field)) {
                $informazioni .= $label . ": " . e($request->$field) . "<br>";
            }
        }

        DB::transaction(function () use ($evento, $utente, $totale, $quantita, $informazioni, $request) {
            $nextRicevutaId = Ricevuta::count() + 1;
            
            $ricevuta = Ricevuta::create([
                'ID' => $nextRicevutaId,
                'Totale' => $totale,
                'Quantita' => $quantita,
                'Evento' => $evento->ID,
                'Utente' => $utente->Mail,
                'Informazioni' => $informazioni,
                'Acquisto' => now(),
            ]);

            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'quantity_') === 0) {
                    $tipo_id = intval(str_replace('quantity_', '', $key));
                    $qty = intval($value);
                    for ($i = 0; $i < $qty; $i++) {
                        $nextBigliettoId = Biglietto::count() + 1;

                        $codice = bin2hex(random_bytes(20));
                        Biglietto::create([
                            'ID' => $nextBigliettoId,
                            'Codice' => $codice,
                            'Evento' => $evento->ID,
                            'Tipo' => $tipo_id,
                            'Ricevuta' => $nextRicevutaId,
                            'Stato' => 0,
                        ]);
                    }
                }
            }
        });

        return redirect('/profile?buy=1');
    }
}