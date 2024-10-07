@extends('layout.welcome')

@section('content')

<div style="margin-top: 10%" class="container">

  @if($albuns->isEmpty())
  <h1>nothing here!!</h1>
  @else

  <div id="albunsCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach ($albuns->chunk(3) as $index => $albumChunk)
      <div class="carousel-item @if($index == 0) active @endif">
        <div class="row">
          @foreach ($albumChunk as $album)
          <?php $favoritosCollection = collect($favoritos); ?>
          <?php $isFavorito = $favoritosCollection->contains('album_id', $album->id); ?>
          <div class="col-md-4">
            <div class="card mb-3 custom-card"
              style="height: 350px; background-image: url('{{ $album->imagem }}'); background-size: cover; background-position: center;">
              <div class="card-body d-flex flex-column justify-content-end" style="height: 100%;">
                <h3 class="card-title text-white name">{{ $album->titulo }} - {{ $album->ano_lancamento }}</h3>
                <div style="display:flex; gap: 10px">
                  <a href="#" style="width: 150px" class="btn" data-bs-toggle="modal" data-bs-target="#musicasModal{{ $album->id }}">Listen
                    Songs</a>

                  @if (auth()->check() && auth()->user()->type_user == 1)
                  <button type="button" id="edit" class="" data-bs-toggle="modal"
                    data-bs-target="#albumModal{{ $album->id }}">Edit</button>

                  <form action="{{ route('albuns.delete', $album->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delete" class="">Delete</button>
                  </form>
                  @endif
                </div>
                <form
                  action="{{ $isFavorito ? route('favoritos.remove', $album->id) : route('favoritos.add', $album->id) }}"
                  method="POST" class="position-absolute top-0 end-0 p-2">
                  @csrf
                  @if ($isFavorito)
                  @method('DELETE')
                  <button type="submit" class="btn" title="Remove from Favorites">
                    <i style="color: white" class="bi bi-heart-fill" aria-hidden="true"></i>
                  </button>
                  @else
                  <button type="submit" class="btn" title="Add to Favorites">
                    <i class="bi bi-heart" aria-hidden="true"></i>
                  </button>
                  @endif
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#albunsCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#albunsCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  @endif
</div>

@foreach ($albuns as $album)
@include('components.modal-music')
@include('components.modal-albuns', ['album' => $album])
@endforeach



@endsection
