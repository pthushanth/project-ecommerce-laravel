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
                            <a href="login.html">Produit</a>
                        </li>
                        <li>
                            <a href="register.html">Catégorie</a>
                        </li>
                        <li>
                            <a href="forget-pass.html">Marque</a>
                        </li>
                    </ul>
                </li>

                <li class="has-sub">
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
                </li>
                <li>
                    <a href="map.html">
                        <i class="fas fa-map-marker-alt"></i>Stock
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.clients.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Client
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.orders.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Commande
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.coupons.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Coupons
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.sales.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Promotion
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.notifications.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Notification
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.reviews.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Commentaire
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.ratings.index')}}" style="color:#4272d7">
                        <i class="fas fa-map-marker-alt"></i>Rating
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->