@extends('layout.welcome')

@section('content')

<div style="margin-top: 10%" class="container text-center">

@if(auth()->check() && auth()->user()->type_user == 1)

<h1 style="font-size: 2rem" >Olá, {{ auth()->user()->name }} ! </h1>

<div style="display:flex; gap: 50px; justify-content: center; margin-top: 5%">
    <button style="width: 200px; height: 200px;" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
        <img id="vinil" style="width: 150px" src="{{asset('/images/vinil2.webp')}}" alt=""> <br> add user
    </button>

    <button style="width: 200px; height: 200px;" type="button" data-bs-toggle="modal" data-bs-target="#bandaModal" >
        <img id="vinil" style="width: 150px" src="{{asset('/images/vinil.webp')}}" alt=""> <br> add band
    </button>

    <button style="width: 200px; height: 200px;" type="button" data-bs-toggle="modal" data-bs-target="#albumModal">
        <img id="vinil" style="width: 150px" src="{{asset('/images/vinil3.webp')}}" alt=""> <br> add album
    </button>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
        <button style="width: 200px; height: 200px;" type="submit">
            <img id="vinil" style="width: 150px" src="{{asset('/images/vinil4.webp')}}" alt=""> <br> logout
        </button>
    </form>
</div>

@include('components.modal-albuns')
@include('components.modal-bands')
@include('components.modal-register')
@else

<div style="margin-top: 15%" class="col-12">
    <h1>EmoRadio</h1>
    @if(auth()->check() && auth()->user()->type_user == 0)
    <h2>Olá, {{ auth()->user()->name }} !</h2>
    @else
    <h2>listen to your tears</h2>
    @endif
    <div class="mt-4">
        @if(auth()->check() && auth()->user()->type_user == 0)
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="bi bi-door-open-fill"></i> Logout
                </button>
            </form>
        @else
            <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="bi bi-headphones"></i> Enter
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
                Register <i class="bi bi-music-player-fill"></i>
            </button>
        @endif
    </div>
    @include('components.modal-register')
    @include('components.modal-login')
</div>
@endif

</div>

@endsection
