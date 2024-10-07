<div class="modal fade" id="bandaModal{{ $banda->id ?? '' }}" tabindex="-1" aria-labelledby="bandaModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6><i class="bi bi-music-note-beamed"></i> {{ isset($banda) ? 'Edit Band' : 'Create Band' }}</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div style="text-align: left" class="modal-body">
        <form action="{{ route('bandas.create') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $banda->id ?? '' }}">

          <div class="mb-3">
            <label for="nome" class="form-label"><i class="bi bi-person-fill"></i> Name</label>
            <input name="nome" type="text" class="form-control" id="nome" value="{{ $banda->nome ?? '' }}" required>
            @error('nome')
            <div class="alert alert-danger" role="alert">
              Nome inválido!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="descricao" class="form-label"><i class="bi bi-pencil-fill"></i> Description</label>
            <textarea name="descricao" class="form-control" id="descricao"
              rows="3">{{ $banda->descricao ?? '' }}</textarea>
            @error('descricao')
            <div class="alert alert-danger" role="alert">
              Descrição inválida!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="genero" class="form-label"><i class="bi bi-music-note-list"></i> Genre</label>
            <input name="genero" type="text" class="form-control" id="genero" value="{{ $banda->genero ?? '' }}">
            @error('genero')
            <div class="alert alert-danger" role="alert">
              Gênero inválido!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="imagem" class="form-label"><i class="bi bi-image"></i> Image URL</label>
            <input name="imagem" type="text" class="form-control" id="imagem" value="{{ $banda->imagem ?? '' }}">
            @error('imagem')
            <div class="alert alert-danger" role="alert">
              URL da imagem inválida!
            </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-warning mb-3">{{ isset($banda) ? 'Update' : 'Create' }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
