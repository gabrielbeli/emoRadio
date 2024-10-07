<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Banda;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', null);
    $bandaId = $request->input('banda_id');

    $albuns = $this->getAlbumBase($search, $bandaId);

    $favoritos = [];
    if (auth()->check()) {
        $favoritos = auth()->user()->favoritos()->pluck('album_id')->toArray();
    }

    $bandas = Banda::all();

    return view('albuns.index', compact('albuns', 'favoritos', 'bandas'));
}

protected function getAlbumBase($search, $bandaId)
{
    $query = Album::query();

    if ($bandaId) {
        $query->where('banda_id', $bandaId);
    }

    if ($search) {
        $query->where('titulo', 'like', '%' . $search . '%');
    }

    return $query->get();
}

    public function create(Request $request)
    {
        $action = '';

        if (isset($request->id)) {
            $action = 'updated';

            $request->validate([
                'titulo' => 'required|string|max:255',
                'ano_lancamento' => 'required|integer',
                'imagem' => 'nullable|url',
                'songs' => 'nullable|string',
                'banda_id' => 'required|exists:bandas,id',
            ]);

            Album::where('id', $request->id)->update([
                'titulo' => $request->titulo,
                'ano_lancamento' => $request->ano_lancamento,
                'imagem' => $request->imagem,
                'songs' => $request->songs,
                'banda_id' => $request->banda_id,
            ]);
        } else {
            $action = 'add';

            $request->validate([
                'titulo' => 'required|string|max:255',
                'ano_lancamento' => 'required|integer',
                'imagem' => 'nullable|url',
                'songs' => 'nullable|string',
                'banda_id' => 'required|exists:bandas,id',
            ]);

            Album::insert([
                'titulo' => $request->titulo,
                'ano_lancamento' => $request->ano_lancamento,
                'imagem' => $request->imagem,
                'songs' => $request->songs,
                'banda_id' => $request->banda_id,
            ]);
        }

        return back();
    }

    public function delete($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return back();
    }
}
