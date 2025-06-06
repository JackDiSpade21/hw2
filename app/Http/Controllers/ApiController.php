<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Artista;
use App\Models\Utente;
use App\Models\Evento;
use App\Models\Ricevuta;
use App\Models\Biglietto;

class ApiController extends Controller
{
    public function getHomeCards()
    {
        $rows = Artista::all()->toArray();
        shuffle($rows);
        return response()->json($rows);
    }
    public function checkMail($mail)
    {
        $exists = Utente::where('Mail', $mail)->exists();
        return response()->json(['exists' => $exists]);
    }
    public function getArtista($id)
    {
        $artista = Artista::where('ID', intval($id))->first();
        return response()->json($artista);
    }
    public function getEventiByArtista($id)
    {
        $eventi = Artista::find($id)->eventi;
        return response()->json($eventi);
    }
    public function getQrCode($codice)
    {
        $qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($codice);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $qr_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $qr_image = curl_exec($ch);
        curl_close($ch);

        if ($qr_image === false) {
            return response('');
        }

        return response($qr_image)->header('Content-Type', 'image/png');
    }
    public function getSpotifyTracks($id)
    {
        $spotifyApi = env('SPOTIFY_API');
        $spotifySecret = env('SPOTIFY_SECRET');

        // Step 1
        $artista = Artista::select('Nome', 'Categoria')->where('ID', intval($id))->first();
        if (!$artista || $artista->Categoria !== 'Musica') {
            return response()->json([]);
        }
        $name = urlencode($artista->Nome);

        // Step 2
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Authorization: Basic ' . base64_encode($spotifyApi . ':' . $spotifySecret),
            'Content-Type: application/x-www-form-urlencoded'
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);

        $token_json = json_decode($response, true);
        if (!isset($token_json['access_token'])) {
            return response()->json([]);
        }
        $token = $token_json['access_token'];

        // Step 3
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?q=$name&type=artist");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $artist_response = curl_exec($curl);
        curl_close($curl);

        $artist_json = json_decode($artist_response, true);
        if (
            !isset($artist_json['artists']['items'][0]['id'])
        ) {
            return response()->json([]);
        }
        $artistId = $artist_json['artists']['items'][0]['id'];
        $artistImg = null;
        if (!empty($artist_json['artists']['items'][0]['images'])) {
            $artistImg = $artist_json['artists']['items'][0]['images'][0]['url'];
        }

        // Step 4
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/artists/$artistId/top-tracks?market=IT");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $tracks_response = curl_exec($curl);
        curl_close($curl);

        $tracks_json = json_decode($tracks_response, true);

        return response()->json([
            'artistImg' => $artistImg,
            'tracks' => $tracks_json['tracks']
        ]);
    }
    public function getOwnedTicketDetails($ricevutaId, Request $request)
    {
        $email = session('Mail');

        if (!$email || !$ricevutaId) {
            return response()->json([]);
        }

        $ricevuta = Ricevuta::where('ID', $ricevutaId)
            ->where('Utente', $email)
            ->first();

        if (!$ricevuta) {
            return response()->json([]);
        }

        $biglietti = Biglietto::with(['evento', 'posto'])
            ->where('Ricevuta', $ricevutaId)
            ->get();

        $today = date('Y-m-d');

        foreach ($biglietti as $biglietto) {
            if ($biglietto->evento && $biglietto->evento->DataEvento < $today && $biglietto->Stato != 2) {
                $biglietto->Stato = 2;
                $biglietto->save();
            }
        }

        return response()->json($biglietti);
    }
    public function getOwnedTickets(Request $request)
    {
        $email = session('Mail');
        if (!$email) {
            return response()->json([]);
        }

        $start = intval($request->query('start', 0));
        $count = intval($request->query('count', 5));

        $ricevute = Ricevuta::with(['evento.artista'])
            ->where('Utente', $email)
            ->orderByDesc('Acquisto')
            ->skip($start)
            ->take($count)
            ->get();

        return response()->json($ricevute);
    }
    public function searchResults($query)
    {
        $query = trim($query);
        if (empty($query)) {
            return response()->json([]);
        }

        $artisti = Artista::where('Nome', 'LIKE', "%$query%")
            ->orWhere('Categoria', 'LIKE', "%$query%")
            ->get();

        $eventi = Evento::where('Nome', 'LIKE', "%$query%")
            ->orWhere('Luogo', 'LIKE', "%$query%")
            ->get();

        return response()->json([
            'artisti' => $artisti,
            'eventi' => $eventi
        ]);
    }
}
