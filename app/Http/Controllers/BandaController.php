<?php

namespace App\Http\Controllers;

use App\Models\Banda;
use Illuminate\Http\Request;

class BandaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', null);

        $bandas = $this->getBandaBase($search);

        return view('bandas.index', compact('bandas'));
    }

    protected function getBandaBase($search)
    {
        if ($search) {

            return Banda::where('nome', 'like', '%' . $search . '%')->get();
        } else {
            return Banda::all();
        }
    }

    public function show($id)
    {
        $banda = Banda::findOrFail($id);
        return response()->json($banda);
    }

    public function create(Request $request)
    {
        $action = '';

        if (isset($request->id)) {
            $action = 'updated';

            $request->validate([
                'nome' => 'required|string|max:255',
                'genero' => 'required|string|max:255',
                'descricao' => 'nullable|string|max:1000',
            ]);

            Banda::where('id', $request->id)->update([
                'nome' => $request->nome,
                'genero' => $request->genero,
                'descricao' => $request->descricao,
                'imagem' => $request->imagem,
            ]);
        } else {
            $action = 'add';

            $request->validate([
                'nome' => 'required|string|max:255',
                'genero' => 'required|string|max:255',
                'descricao' => 'nullable|string|max:1000',
            ]);

            Banda::insert([
                'nome' => $request->nome,
                'genero' => $request->genero,
                'descricao' => $request->descricao,
                'imagem' => $request->imagem,
            ]);
        }

        return back();
    }

    public function delete($id)
    {
        $banda = Banda::findOrFail($id);
        $banda->delete();

        return back();
    }
}
