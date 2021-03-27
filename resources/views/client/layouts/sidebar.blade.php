<!-- MENU SIDEBAR-->
<aside class="menu-sidebar2">
    <div class="logo">
        <a href="{{route('home')}}">
            <img src="{{asset('images/logo.png')}}" alt="Tech Zone" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="{{asset(Auth::user()->getAvatarUrl())}}" alt="profile" />

            </div>
            <h4 class="name text-center">{{Auth::user()->name}}</h4>
            <a href="{{ route('logout') }}" style="font-size: 1em"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="zmdi zmdi-power"> </i> Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- <a href="{{ route('logout') }}"></a> --}}
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{route('client.dashboard')}}">
                        <i class="fas fa-chart-bar"></i>Tableau de bord</a>
                </li>
                <li>
                    <a href="{{route('client.account')}}">
                        <i class="zmdi zmdi-account"></i>Mes info perso</a>
                </li>
                <li>
                    <a href="{{route('client.orders')}}">
                        <i class="fas fa-shopping-basket"></i>Mes commandes</a>
                </li>
                <li>
                    <a href="{{route('client.reviews')}}">
                        <i class="fas fa-shopping-basket"></i>Mes avis</a>
                </li>
                <li>
                    <a href="{{route('client.wishlist.index')}}">
                        <i class="fas fa-shopping-basket"></i>Ma list d'envie</a>
                </li>
                {{-- <li>
                    <a href="inbox.html">
                        <i class="zmdi zmdi-notifications"></i>Notification</a>
                    <span class="inbox-num">3</span>
                </li> --}}

            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->