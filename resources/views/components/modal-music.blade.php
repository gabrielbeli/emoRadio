<div class="modal fade" id="musicasModal{{ $album->id }}" tabindex="-1" aria-labelledby="musicasModalLabel{{ $album->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px);">
            <div class="modal-header">
                <h5 class="modal-title" id="musicasModalLabel{{ $album->id }}"><i class="bi bi-music-note-beamed"></i>  {{ $album->titulo }} - Songs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="450" scrolling="no" frameborder="no" allow="autoplay" src="{{ $album->songs }}"></iframe>
            </div>
        </div>
    </div>
</div>
