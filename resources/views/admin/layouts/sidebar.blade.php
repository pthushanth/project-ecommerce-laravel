<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('images/logo.png')}}" alt="Tech Zone" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{route('admin.dashboard')}} ">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Catalogue
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
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

                {{-- <li class="has-sub">
                    <a class="js-arrow" href="#" style="color:#4272d7">
                        <i class="fas fa-plus"></i>Creation
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.products.create')}}">Produit</a>
                </li>
                <li>
                    <a href="{{route('admin.attributes.create')}}">Attribut Produit</a>
                </li>
                <li>
                    <a href="{{route('admin.categories.create')}}">Catégorie</a>
                </li>
                <li>
                    <a href="{{route('admin.brands.create')}}">Marque</a>
                </li>
                <li>
                    <a href="{{route('admin.sales.create')}}">Promotion</a>
                </li>
            </ul>
            </li>
            <li class="has-sub">
                <a class="js-arrow" href="#" style="color:#4272d7">
                    <i class="fas fa-list-ol"></i>Affichage
                </a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{route('admin.products.index')}}">Produit</a>
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
            </li> --}}
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
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->