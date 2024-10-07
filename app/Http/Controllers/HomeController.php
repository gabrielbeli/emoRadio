<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Banda;
use App\Models\Album;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $bandas = Banda::all();
        $albuns = Album::all();
        $users = User::all();

        return view('home', compact('bandas', 'albuns', 'users'));
    }

}
