<header>
  <div class="container-fluid">

    <nav class="navbar  navbar-expand-md navbar-dark justify-content-center">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{asset('images/logo.png')}}" class="d-inline-block align-top logo" alt="">
        </a>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="{{route('products')}}">Produits <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Nouveaux Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Plus vendu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Promotions</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto icone">
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{route('client.dashboard')}}"><i class="fas fa-user"></i></a>
          </li>
          <li class="nav-item mx-2 ">
            <a class="nav-link" href="#"><i class="fas fa-heart"></i></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link cart" href="{{route('cart')}}">
              <i class="fas fa-shopping-bag"></i>
              @if(!empty($cartCount) && $cartCount)
              <span class="badge">{{$cartCount}}</span>
              @endif
            </a>
          </li>
        </ul>
        {{-- <img src="{{asset('images/account.png')}}" class="icone" alt=""> --}}
        {{-- <img src="{{asset('images/cart.png')}}" class="icone" alt=""> --}}

      </div>
    </nav>
  </div>

</header>