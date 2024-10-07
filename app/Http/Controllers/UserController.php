<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function index()
{
    $search = request()->input('search', null);

    $users = $this->getContactBase($search);

    return view('users.index', compact('users'));
}

protected function getContactBase($search = null)
{
    $query = User::withCount('favoritos');

    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    return $query->get();
}


public function show($id)
{
    $user = User::findOrFail($id);
    return response()->json($user);
}

public function deleteUserId($id)
{

    $user = User::findOrFail($id);
    $user->delete();

    return back();
}

public function create(Request $request){

    $action = '';

    if(isset($request->id)){
        $action = 'updated';

        $request->validate([
            'name' => 'string|max:50',
            'imagem' => 'nullable|image',

        ]);

        $imagem = null;

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('uploadedImages', 'public');
        }

        User::where('id', $request->id)->update([
            'name' =>$request->name,
            'imagem' => $imagem,
        ]);

    } else {
        $action = 'add';

        $request->validate([
            'name' => 'string|max:50',
            'email' => 'email|unique:users',
            'password' => 'min:6',
            'imagem' => 'nullable|image',
        ]);

        $imagem = null;

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('uploadedImages', 'public');
        }

        User::insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'imagem' => $imagem,
        ]);

        }

        return redirect()->route('users.index');
    }

}
