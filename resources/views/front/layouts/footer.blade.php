<footer>
    <div class="container-fluid px-0">
        <div class="row no-gutters text-center">
            <div class="col-sm-6 col-md-3 py-3 detail ">
                <img src="{{asset('images/logo.png')}}" class="logo" alt="logo">
                <p>01 23 45 67 89</p>
                <p>contact@techzone.com</p>
                <div class="reseaux-sociaux">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 py-3">
                <p class="titre">Produit</p>
                <a href="{{route('products.new')}}">Nouveaux produits</a>
                <a href="{{route('products.bestseller')}}">Plus vendu</a>
                <a href="{{route('products.new')}}">Meilleur noté</a>
                <a href="{{route('products.sale')}}">Solde</a>
            </div>
            <div class="col-sm-6 col-md-3 py-3">
                <p class="titre">Mon Compte</p>
                <a href="{{route('client.dashboard')}}">Se connecter</a>
                <a href="{{route('client.dashboard')}}">Mon compte</a>
                <a href="{{route('register')}}">S'incrire</a>
            </div>
            <div class="col-sm-6 col-md-3 py-3">
                <p class="titre">Paiement</p>
                <i class="fab fa-cc-stripe"></i>
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
        </div>
    </div>
</footer>