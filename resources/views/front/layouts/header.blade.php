<header>
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-3">
            <img src="{{asset('images/logo.png')}}" class="logo" alt="logo">
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button">Button</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <img src="{{asset('images/account.png')}}" class="icone" alt="">
            <img src="{{asset('images/cart.png')}}" class="icone" alt="">
        </div>
    </div>

    {{-- <div class="row mt-4 justify-content-center align-items-center">
        <div class="col-md-3">
            <p>ALL CATEGORIES</p>
        </div>
        <div class="col-md-2">
            <p>ALL PRODUCTS</p>
        </div>
        <div class="col-md-2">
            <p>NEW PRODUCTS</p>
        </div>
        <div class="col-md-2">
            <p>BESTSELLER</p>
        </div>
        <div class="col-md-2">
            <p>SALES</p>
        </div>
    </div>   --}}
    <nav class="navbar navbar-expand-lg navbar-dark justify-content-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
              <a class="nav-link" href="#">Produits <span class="sr-only">(current)</span></a>
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

        </div>
      </nav>
</div>
    
</header>