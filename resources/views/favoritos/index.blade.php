@extends('layout.welcome')

@section('content')

<div style="margin-top: 10%" class="container">

    @if($favoritos->isEmpty())
        <h1>nothing here!!</h1>
    @else

    <div id="favoritosCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($favoritos->chunk(3) as $index => $favoritoChunk)
                <div class="carousel-item @if($index == 0) active @endif">
                    <div class="row">
                        @foreach ($favoritoChunk as $favorito)
                            <div class="col-md-4">
                                <div class="card mb-3 custom-card" style="height: 350px; background-image: url('{{ $favorito->album->imagem }}'); background-size: cover; background-position: center;">
                                    <div class="card-body d-flex flex-column justify-content-end" style="height: 100%;">
                                        <h3 class="card-title text-white name">{{ $favorito->album->titulo }} - {{ $favorito->album->ano_lancamento }}</h3>

                                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#musicasModal{{ $favorito->album->id }}">Listen Songs</a>

                                        <form action="{{ route('favoritos.remove', $favorito->album->id) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" title="Remove from Favorites">
                                                <i class="bi bi-heart-fill" aria-hidden="true" style="color: white;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#favoritosCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#favoritosCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif
</div>

@endsection
