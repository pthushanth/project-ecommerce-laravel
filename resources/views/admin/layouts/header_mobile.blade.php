<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{asset('images/logo.png')}}" alt="TechZone" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a href="{{route('admin.dashboard')}} ">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Catalogue
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{route('admin.products.index')}}">
                                Produit
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.attributes.index')}}">Attribut Produit</a>
                        </li>
                        <li>
                            <a href="{{route('admin.categories.index')}}">Catégorie</a>
                        </li>
                        <li>
                            <a href="{{route('admin.brands.index')}}">Marque</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.stocks.index')}}">
                        <i class="fas fa-shipping-fast"></i>Stock
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.clients.index')}}">
                        <i class="fas fa-users"></i>Client
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.orders.index')}}">
                        <i class="fas fa-clipboard-list"></i>Commande
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.coupons.index')}}">
                        <i class="fas fa-tag"></i>Coupons
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.product_sales.index')}}">
                        <i class="fas fa-tags"></i>Promotion
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.notifications.index')}}">
                        <i class="fas fa-bell"></i>Notification
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.reviews.index')}}">
                        <i class="fas  fa-star"></i>Commentaire
                        {{-- <i class="fas fa-comment-alt"></i>Commentaire --}}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->