<header>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 text-center col-md-9 col-lg-10 justify-content-left">
        <nav class="navbar navbar-expand-md navbar-dark justify-content-center">

          <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">
              <img src="{{asset('images/logo.png')}}" class="d-inline-block align-top logo" alt="">
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mx-auto">
              <li class="nav-item dropdown" {{ Request::is('/produits/filter?type=category*') ? 'active' : '' }}>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach ($cat as $category)
                  <a class="dropdown-item"
                    href="{{url('/produits/filter?type=category&category='.$category->id)}}">{{$category->name}}</a>
                  @endforeach
                </div>
              </li>

              <li class="nav-item {{ Request::is('produits') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('products')}}">Produits </a>
              </li>
              <li class="nav-item {{ Request::routeIs('products.new') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('products.new')}}">Nouveaux
                  Produits</a>
              </li>
              <li class="nav-item {{ Request::routeIs('products.bestseller')  ? 'active' : '' }}">
                <a class="nav-link" href="{{route('products.bestseller')}}">Plus vendu</a>
              </li>
              <li class="nav-item {{ Request::routeIs('products.sale')  ? 'active' : '' }}">
                <a class="nav-link" href="{{route('products.sale')}}">Promotions</a>
              </li>
            </ul>

            {{-- <img src="{{asset('images/account.png')}}" class="icone" alt=""> --}}
            {{-- <img src="{{asset('images/cart.png')}}" class="icone" alt=""> --}}
          </div>

        </nav>
      </div>
      <div class="col-12 col-md-3 col-lg-2 text-center text-sm-right icone">
        <div class="btn-group" role="group">
          @if(Auth::user() && Auth::user()->isClient())
          <a href="#" class="btn dropdown-toggle pr-0" data-toggle="dropdown"> <img
              src="{{asset(Auth::user()->getAvatarUrl())}}" width="40" height="40" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-center">
            <p class="text-primary text-center"><strong>{{Auth::user()->name}}</strong></p>
            <a class="dropdown-item" href="{{route('client.dashboard')}}">Mon compte</a>
            <a class="dropdown-item" href="{{route('client.account')}}">Modifier mes info</a>
            <a class="dropdown-item" href="{{route('client.orders')}}">Mes commandes</a>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="zmdi zmdi-power"></i>Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
          @else
          <a class="btn" href="{{route('client.dashboard')}}"><i class="fas fa-user"></i></a>
          @endif
          <a class="btn" href="#"><i class="fas fa-heart"></i></a>
          <a class="btn cart" href="{{route('cart')}}">
            <i class="fas fa-shopping-bag"></i>
            @if(!empty($cartCount) && $cartCount)
            <span class="badge">{{$cartCount}}</span>
            @endif
          </a>
          </li>
          </ul>
        </div>

      </div>
    </div>

  </div>

</header>

{{-- <ul class="navbar-nav ml-auto icone">
  @if(Auth::user() && Auth::user()->isClient())
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar-list-4">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="{{asset(Auth::user()->getAvatarUrl())}}" width="40" height="40" class="rounded-circle">
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
  <p class="text-primary text-center"><strong>{{Auth::user()->name}}</strong></p>
  <a class="dropdown-item" href="{{route('client.dashboard')}}">Mon compte</a>
  <a class="dropdown-item" href="{{route('client.account')}}">Modifier mes info</a>
  <a class="dropdown-item" href="{{route('client.orders')}}">Mes commandes</a>
  <a class="dropdown-item text-danger" href="{{ route('logout') }}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    <i class="zmdi zmdi-power"></i>Se déconnecter
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</div>
</li>
</ul>
</div>
@else
<li class="nav-item">
  <a class="nav-link" href="{{route('client.dashboard')}}"><i class="fas fa-user"></i></a>
</li>
@endif
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
</ul> --}}