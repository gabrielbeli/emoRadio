<div class="modal fade" id="albumModal{{ $album->id ?? '' }}" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6><i class="bi bi-music-note"></i> {{ isset($album) ? 'Edit Album' : 'Create Album' }}</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div style="text-align: left" class="modal-body">
        <form action="{{ route('albuns.create') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $album->id ?? '' }}">

          <div class="mb-3">
            <label for="albumTitle" class="form-label"><i class="bi bi-card-heading"></i> Title</label>
            <input name="titulo" type="text" class="form-control" id="albumTitle" value="{{ $album->titulo ?? '' }}"
              required>
            @error('titulo')
            <div class="alert alert-danger" role="alert">
              Invalid title!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="releaseYear" class="form-label"><i class="bi bi-calendar"></i> Release Year</label>
            <input name="ano_lancamento" type="number" class="form-control" id="releaseYear"
              value="{{ $album->ano_lancamento ?? '' }}" required>
            @error('ano_lancamento')
            <div class="alert alert-danger" role="alert">
              Invalid release year!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="banda_id" class="form-label"><i class="bi bi-music-note"></i> Banda</label>
            <select name="banda_id" class="form-select" id="banda_id" required>
              <option value="">Select Banda</option>
              @foreach ($bandas as $banda)
              <option value="{{ $banda->id }}"
                {{ (isset($album) && $album->banda_id == $banda->id) ? 'selected' : '' }}>
                {{ $banda->nome }}
              </option>
              @endforeach
            </select>
            @error('banda_id')
            <div class="alert alert-danger" role="alert">
              Please select a banda!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="albumImage" class="form-label"><i class="bi bi-image"></i> Image URL</label>
            <input name="imagem" type="text" class="form-control" id="albumImage" value="{{ $album->imagem ?? '' }}">
            @error('imagem')
            <div class="alert alert-danger" role="alert">
              Invalid image URL!
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="albumSongs" class="form-label"><i class="bi bi-music-note-list"></i> Songs URL</label>
            <input name="songs" class="form-control" id="albumSongs" rows="3"
              required value="{{ $album->songs ?? '' }}">
            @error('songs')
            <div class="alert alert-danger" role="alert">
              Invalid songs URL!
            </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-warning mb-3">{{ isset($album) ? 'Update' : 'Create' }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
