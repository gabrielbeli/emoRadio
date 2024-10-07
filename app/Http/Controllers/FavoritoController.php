<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function add($albumId)
    {

        if (auth()->check()) {

            $existingFavorite = Favorito::where('user_id', auth()->id())
            ->where('album_id', $albumId)
            ->first();

            if (!$existingFavorite) {
                $favorito = new Favorito();
                $favorito->user_id = auth()->id();
                $favorito->album_id = $albumId;
                $favorito->save();
            }

            return back();
        }

        return back();
    }

    public function remove($albumId)
    {

        if (auth()->check()) {
            $favorito = Favorito::where('user_id', auth()->id())
                ->where('album_id', $albumId)
                ->first();

            if ($favorito) {
                $favorito->delete();

                return back();
            }

            return back();
        }

        return back();
    }

    public function index(Request $request)
{

    $search = $request->input('search', null);

    $query = Favorito::where('user_id', auth()->id())->with('album');

    if ($search) {
        $query->whereHas('album', function ($q) use ($search) {
            $q->where('titulo', 'like', '%' . $search . '%');
        });
    }

    $favoritos = $query->get();

    return view('favoritos.index', compact('favoritos'));
}

}
