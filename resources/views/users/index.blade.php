@extends('layout.welcome')

@section('content')

@if($users->isEmpty())
<h1 style="margin-top:10%">nothing here!!</h1>
@else

<div style="margin-top: 10%; gap: 15px; display:flex; flex-direction:column" class="Container">

  <div class="table-scroll">
    <table style="color: white; width: 100%;" class="table-custom">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Photo</th>
        <th scope="col">Name</th>
        <th scope="col">Favorites</th>
        <th scope="col">Email</th>
        <th style="text-align: center;" scope="col">Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $item)
    <tr>
        <th scope="row">{{ $item->id }}</th>
        <td>
            <img style="width: 50px; border-radius: 100%;" src="{{ $item->imagem ? asset('storage/' . $item->imagem) : asset('images/photo.png') }}">
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->favoritos_count ?? 0 }}</td>
        <td>{{ $item->email }}</td>
        <td style="display: flex; gap: 15px; justify-content: center">
            <div class="userIDModal">
                <a type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#userIDModal{{ $item->id }}">
                    SEE | EDIT
                </a>
                <a href="{{ route('users.delete', $item->id) }}" class="btn btn-warning">Delete</a>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>


      @foreach ($users as $item)
      <div class="modal fade" id="userIDModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6><i class="bi bi-music-player"></i> User!</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{route('users.create')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                <div class="mb-3">
                  <label for="exampleInputName1" class="form-label"><i class="bi bi-person-fill"></i> Name</label>
                  <input name="name" value="{{$item->name}}" type="text" class="form-control" id="exampleInputName1"
                    required>
                  @error('name')
                  <div class="alert alert-danger" role="alert">name inválido!</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
                  <input name="email" value="{{$item->email}}" type="email" class="form-control" id="exampleInputEmail1"
                    required disabled>
                  @error('email')
                  <div class="alert alert-danger" role="alert">email inválido!</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputPhoto1" class="form-label"><i class="bi bi-camera-fill"></i> Upload Foto</label>
                  <input name="imagem" type="file" accept="image/*" class="form-control" id="exampleInputPhoto1">
                  @error('imagem')
                  <div class="alert alert-danger" role="alert">
                    Arquivo inválido!
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning mb-3">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </table>
  </div>
  @endif

  <div style="display: flex; justify-content: space-between; margin-top: 20px">

    <a class="btn" style="text-decoration: none; color:rgba(255, 255, 255, 0.3); padding-left:0 " href="/"><i
        style="color:rgba(255, 255, 255, 0.3);" class="bi bi-arrow-left-square-fill"></i> Voltar</a>

    <div class="registerModal">
      <button type="button" class="" data-bs-toggle="modal" data-bs-target="#registerModal">
        <i class="bi bi-person-fill-add"></i> REGISTER
      </button>
    </div>
  </div>

  @include('components.modal-register')

</div>
@endsection
