<?php
namespace App\Http\Controllers;
use App\Models\Artista;

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
}