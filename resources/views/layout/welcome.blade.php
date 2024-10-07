<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EmoRadio</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

  <nav class="nav nav-pills nav-fill">
    <a class="nav-link item-logo {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/"><i
        class="bi bi-house-door-fill"></i> Home</a>

    @if(auth()->check() && auth()->user()->type_user == 1)
    <a class="nav-link {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}"
      href="{{ route('users.index') }}"><i class="bi bi-person-circle"></i> Users</a>
    @endif

    <a class="nav-link {{ Route::currentRouteName() == 'bandas.index' ? 'active' : '' }}"
      href="{{ route('bandas.index') }}"><i class="bi bi-boombox"></i> Bands</a>

    <a class="nav-link {{ Route::currentRouteName() == 'albuns.index' ? 'active' : '' }}"
      href="{{ route('albuns.index') }}"><i class="bi bi-vinyl"></i> Albums</a>
    @if(auth()->check())
    <a class="nav-link {{ Route::currentRouteName() == 'favoritos.index' ? 'active' : '' }}"
      href="{{ route('favoritos.index') }}"><i class="bi bi-star-fill"></i> Favorite</a>
    @endif

    <form class="row g-2 justify-content-center align-items-center" action="">
      <div class="col-auto">
        <label for="inputSearch2" class="visually-hidden">Search</label>
        <input style="margin-left: 30px; width: 200px" type="text" name="search" class="form-control" id="inputSearch2" placeholder="Input name or part of ">
      </div>
      <div class="col-auto">
        <button type="submit" class=""><i class="bi bi-search-heart"></i> Search</button>
      </div>
    </form>

  </nav>

  <!--<footer>
        <a target="_blank" href="https://www.instagram.com/gabriel_beli"><i class="bi bi-instagram"></i></a>
    </footer>-->

  <div class="container">

    @yield('content')
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

</body>

</html>
