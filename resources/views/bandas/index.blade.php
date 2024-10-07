@extends('layout.welcome')

@section('content')

<div style="margin-top: 10%" class="container">

  @if($bandas->isEmpty())
  <h1>nothing here!!</h1>
  @else

  <div style="margin-top: 5%" id="bandasCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach ($bandas->chunk(3) as $index => $bandaChunk)
      <div class="carousel-item @if($index == 0) active @endif">
        <div class="row">
          @foreach ($bandaChunk as $banda)
          <div class="col-md-4">
            <div class="card mb-3 custom-card"
              style="height: 350px; background-image: url('{{ $banda->imagem }}'); background-size: cover; background-position: center;">
              <div class="card-body d-flex flex-column justify-content-end" style=" height: 100%;">
                <h3 class="card-title text-white name">{{ $banda->nome }} - <small>{{ $banda->genero }}</small></h3>
                <p class="card-text text-white description">{{ $banda->descricao }}</p>

                <div style="display:flex; gap: 10px">
                  <a id="album" style="width: 150px" href="{{ route('albuns.index', ['banda_id' => $banda->id]) }}"
                    class="btn">Albuns</a>

                  @if (auth()->check() && auth()->user()->type_user == 1)
                  <div class="bandaIDModal">
                    <button type="button" id="edit" class="btn btn-warning" data-bs-toggle="modal"
                      data-bs-target="#bandaModal{{ $banda->id }}">
                      Edit
                    </button>
                  </div>
                  <form action="{{ route('bandas.delete', $banda->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delete" class="btn btn-danger"
                      onclick="return confirm('Tem certeza que deseja deletar?')">Delete</button>
                  </form>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @include('components.modal-bands', ['banda' => $banda])
          @endforeach
        </div>
      </div>
      @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#bandasCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bandasCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  @endif
</div>

@endsection
