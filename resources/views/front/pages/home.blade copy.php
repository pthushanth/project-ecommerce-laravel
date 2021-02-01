@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>
  .glider {
    overflow-x: hidden;
  }

  element.style {
    width: 300px;
  }

  .slick-initialized .slick-slide {
    display: block;
  }

  .slick-slide {
    float: left;
    height: 100%;
    min-height: 1px;
    display: none;
  }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/glider.css') }}">
@endsection

@section('content')
<section id="sectionSlider">
  <div id="sliderIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#sliderIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#sliderIndicators" data-slide-to="1"></li>
      <li data-target="#sliderIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{ asset('images/slider1.jpg') }}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('images/slider2.jpg') }}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('images/slider3.jpg') }}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#sliderIndicators" role="button" data-slide="prev">
      <p class="carousel-control-prev-icon" aria-hidden="true"></p>
      <p class="sr-only">Previous</p>
    </a>
    <a class="carousel-control-next" href="#sliderIndicators" role="button" data-slide="next">
      <p class="carousel-control-next-icon" aria-hidden="true"></p>
      <p class="sr-only">Next</p>
    </a>
  </div>
</section>

<section id="sectionAvantages">
  <div class="container">
    <div class="row mt-4 text-center  max-width-row">
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/avantage1.png') }}" alt="Card image cap">
          </div>
          <div class="card-body">
            <p class="title">24/7 Support</p>
            <p>Online support 24/7</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/avantage1.png') }}" alt="Card image cap">
          </div>
          <div class="card-body">
            <p class="title">Secure Payment</p>
            <p>100% secure payment</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/avantage1.png') }}" alt="Card image cap">
          </div>
          <div class="card-body">
            <p class="title">Specail Gift Cards</p>
            <p>give the perfect gift</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/avantage1.png') }}" alt="Card image cap">
          </div>
          <div class="card-body">
            <p class="title">World Wide Shipping</p>
            <p>On order over $100</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="sectionCategories">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card img-fluid align-items-center justify-content-center" style="width:500px">
          <img class="card-img-top" src="{{ asset('images/slider2.jpg') }}" alt="Card image" style="width:100%">
          <div class="card-img-overlay align-items-center d-flex justify-content-center">
            <a href="#" class="btn btnCategorie">TELEVISON</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card img-fluid align-items-center justify-content-center" style="width:500px">
          <img class="card-img-top" src="{{ asset('images/slider2.jpg') }}" alt="Card image" style="width:100%">
          <div class="card-img-overlay align-items-center d-flex justify-content-center">
            <a href="#" class="btn btnCategorie">PC</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card img-fluid align-items-center justify-content-center" style="width:500px">
          <img class="card-img-top" src="{{ asset('images/slider2.jpg') }}" alt="Card image" style="width:100%">
          <div class="card-img-overlay align-items-center d-flex justify-content-center">
            <a href="#" class="btn btnCategorie">LAPTOP</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card img-fluid align-items-center justify-content-center" style="width:500px">
          <img class="card-img-top" src="{{ asset('images/slider2.jpg') }}" alt="Card image" style="width:100%">
          <div class="card-img-overlay align-items-center d-flex justify-content-center">
            <a href="#" class="btn btnCategorie">WATCH</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section id="sectionProduits">
  {{-- <div class="container">
        <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-lg-4 col-md-3">
                          <div class="card">
                            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
  <div class="card-body text-center">
    <a href="#" class="categorie">Laptop - Asus</a>
    <div class="rating">
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star-half-o"></i>
    </div>
    <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
    <p class="prix">1499,99 €</p>
    <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
  </div>
  </div>
  </div>
  </div>
  <div class="carousel-item">
    <div class="col-lg-4 col-md-3">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
        <div class="card-body text-center">
          <a href="#" class="categorie">Laptop - Asus</a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
          <p class="prix">1499,99 €</p>
          <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
        </div>
      </div>
    </div>
  </div>
  <div class="carousel-item">
    <div class="col-lg-4 col-md-3">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
        <div class="card-body text-center">
          <a href="#" class="categorie">Laptop - Asus</a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
          <p class="prix">1499,99 €</p>
          <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
        </div>
      </div>
    </div>
  </div>
  <div class="carousel-item">
    <div class="col-lg-4 col-md-3">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
        <div class="card-body text-center">
          <a href="#" class="categorie">Laptop - Asus</a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
          <p class="prix">1499,99 €</p>
          <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
        </div>
      </div>
    </div>
  </div>
  <div class="carousel-item">
    <div class="col-lg-4 col-md-3">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
        <div class="card-body text-center">
          <a href="#" class="categorie">Laptop - Asus</a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
          <p class="prix">1499,99 €</p>
          <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
        </div>
      </div>
    </div>
  </div>
  <div class="carousel-item">
    <div class="col-lg-4 col-md-3">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
        <div class="card-body text-center">
          <a href="#" class="categorie">Laptop - Asus</a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
          <p class="prix">1499,99 €</p>
          <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
        </div>
      </div>
    </div>
  </div>
  </div>
  <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
  </div>
  </div> --}}
  <div class="container-fluid">
    <div class="buttons">
      <a class="showProductDiv" target="newProduct" onclick="showProductDiv(this.target)">New products</a>
      <a class="showProductDiv" target="topRated" onclick="showProductDiv(this.target)">Top rated</a>
      <a class="showProductDiv" target="bestSeller" onclick="showProductDiv(this.target)">Best seller</a>
    </div>

    <div class="glider-contain">
      <div id="newProduct" class="productDiv">
        <h2>New products</h2>
        <div class="glider">
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
            <div class="card-body text-center">
              <a href="#" class="categorie">Laptop - Asus</a>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
              </div>
              <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
              <p class="prix">1499,99 €</p>
              <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
            </div>
          </div>
        </div>

        <div id="topRated" class="productDiv">
          <h2>Top rated</h2>
          <div class="glider">
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/iphone12.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Smartphone - Apple</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a href="#" class="produit-titre">Iphone 12 pro max 256 go</a>
                <p class="prix">1259,00 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
          </div>
        </div>

        <div id="bestSeller" class="productDiv">
          <h2>Best seller</h2>
          <div class="glider">
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="{{ asset('images/test/product.jpg') }}" alt="Card image cap">
              <div class="card-body text-center">
                <a href="#" class="categorie">Laptop - Asus</a>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <a href="#" class="produit-titre">Asus Zenbook UX481FA</a>
                <p class="prix">1499,99 €</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="glider-prev">&laquo;</button>
      <button class="glider-next">&raquo;</button>
      {{-- <div id="dots"></div> --}}
    </div>
</section>

@endsection

@section('scripts')

<script src="{{ asset('js/glider.js') }}"></script>
<script src="{{ asset('js/gliderFunction.js') }}"></script>
<script>
  window.addEventListener('load', function() {
    $('.productDiv').hide();
    $('#newProduct').show();
    showGlider('#newProduct .glider');
  });

  function showProductDiv(divName) {
    $('.productDiv').hide();
    $('#' + divName).show();
    showGlider('#' + divName + ' .glider');


  }
</script>
@endsection