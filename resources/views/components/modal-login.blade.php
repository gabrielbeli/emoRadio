<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="bi bi-headphones"></i> Enter!</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div style="text-align: left" class="modal-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="mb-3 text-start">
            <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            @error('email')
            <div class="alert alert-danger mt-2" role="alert">
              email inválido!
            </div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="exampleInputPassword1" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
            @error('password')
            <div class="alert alert-danger mt-2" role="alert">
              password inválido!
            </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-warning mb-3 w-auto">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

