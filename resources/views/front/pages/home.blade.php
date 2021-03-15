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
    <div class="row mt-4 text-center max-width-row">
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/009-24-hours.png') }}">
          </div>
          <div class="card-body">
            <p class="title">Assistance 24/7</p>
            <p>Assistance en ligne 24h / 24 et 7j / 7</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/035-credit-card-3.png') }}">
          </div>
          <div class="card-body">
            <p class="title">Paiement sécurisé</p>
            <p>Paiement 100% sécurisé</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/017-gift-card.png') }}">
          </div>
          <div class="card-body">
            <p class="title">Cartes-Cadeaux</p>
            <p>Offrir le cadeau parfait</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="div-icone d-flex flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('images/007-delivery-truck.png') }}">
          </div>
          <div class="card-body">
            <p class="title">Livraison gratuit</p>
            <p>Livraison gratuite dans le monde entier</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="sectionCategories">
  <div class="container-fluid">
    <div class="row justify-content-center">
      @foreach ($categories as $category)
      <div class="col-md-6 col-lg-3">
        <div class="card img-fluid align-items-center justify-content-center">
          <img class="card-img-top" src="{{ asset($category->image) }}">
          <div class="card-img-overlay align-items-center d-flex justify-content-center">
            <a href="#" class="btn btnCategorie">{{$category->name}}</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section id="sectionProduits">
  <div class="container-fluid px-5">
    <h2 class="text-center">Collections</h2>
    <nav class="shift">
      <ul class="nav nav-tabs justify-content-center " role="tablist">
        <li class="nav-item">
          <a class="nav-link btn showProductDiv" target="newProduct" data-toggle="tab" role="tab"
            aria-controls="special" aria-selected="false" onclick="showProductDiv(this.target)">Nouveautés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn showProductDiv" target="topRated" data-toggle="tab" role="tab" aria-controls="special"
            aria-selected="false" onclick="showProductDiv(this.target)">Meilleure noté</a>

        </li>
        <li class="nav-item">
          <a class="nav-link btn showProductDiv" target="bestSeller" data-toggle="tab" role="tab"
            aria-controls="special" aria-selected="false" onclick="showProductDiv(this.target)">Top ventes</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" id="special-tab" data-toggle="tab" href="#special" role="tab" aria-controls="special"
            aria-selected="false">Special Offer</a>
        </li> --}}
      </ul>
    </nav>


    <div class="glider-contain">
      <div id="newProduct" class="productDiv">
        <div class="glider">

          @foreach ($latestProducts as $latestProduct)
          @include('front.includes.product_card',['product'=>$latestProduct])
          @endforeach

        </div>
        <button class="glider-prev">&laquo;</button>
        <button class="glider-next">&raquo;</button>
      </div>

      <div id="topRated" class="productDiv">
        <div class="glider">
          @foreach ($topRatedProducts as $topRatedProduct)
          @include('front.includes.product_card',['product'=>$topRatedProduct])
          @endforeach

        </div>
        <button class="glider-prev">&laquo;</button>
        <button class="glider-next">&raquo;</button>
      </div>

      <div id="bestSeller" class="productDiv">
        <div class="glider">
          @foreach ($bestSellerProducts as $bestSellerProduct)
          @include('front.includes.product_card',['product'=>$bestSellerProduct])
          @endforeach
        </div>
        <button class="glider-prev">&laquo;</button>
        <button class="glider-next">&raquo;</button>
      </div>

      {{-- <div id="dots"></div> --}}
    </div>
  </div>
</section>

<section id="sectionOffres">
  <div class="container-fluid px-0">
    <div class="parallax ">
      <div class="masque">
        <div class="container align-self-center">
          <div class="row mt-5 justify-content-center">
            <div class="col-12">
              <h4 class="text-center">OFFRE SPECIAL -25%</h4>
            </div>
            <div class="col-12 mt-3 text-center"><a href="{{''}}" class="btn btn-primary button-cta">Profitez
                maintenant</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="SectionDeals">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 colLeft d-flex px-3">
        <div class="card text-center d-fill">
          <img class="card-img-top" src="{{ asset('images/test/apple_watch.png') }}">
          <div class="card-body ">
            <h5 class="card-title">Apple Watch (Series 3) 38 mm - Aluminium Gris sidéral - Bracelet Sport Noir</h5>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p class="price">184,99 € <span> 239,99 €</span></p>
            <div class="clockdiv">
              <div>
                <span class="days"></span>
                <div class="smalltext">Days</div>
              </div>
              <div>
                <span class="hours"></span>
                <div class="smalltext">Hours</div>
              </div>
              <div>
                <span class="minutes"></span>
                <div class="smalltext">Minutes</div>
              </div>
              <div>
                <span class="seconds"></span>
                <div class="smalltext">Seconds</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 colRight d-flex px-3">
        <div class="card text-center d-fill align-items-center">
          <img class="card-img-top" src="{{ asset('images/test/s20.jpg') }}">
          <div class="card-body ">
            <h5 class="card-title">Samsung Galaxy S20 Gris</h5>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p class="price">789,00 € <span> 1099,00 €</span></p>
            <div class="clockdiv">
              <div>
                <span class="days"></span>
                <div class="smalltext">Days</div>
              </div>
              <div>
                <span class="hours"></span>
                <div class="smalltext">Hours</div>
              </div>
              <div>
                <span class="minutes"></span>
                <div class="smalltext">Minutes</div>
              </div>
              <div>
                <span class="seconds"></span>
                <div class="smalltext">Seconds</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="sectionPromotions">
  <div class="container-fluid px-5">
    <h2 class="text-center">Promotions</h2>
    <div class="glider-contain">
      <div class="glider">
        @foreach ($saleProducts as $saleProduct)
        @include('front.includes.product_card',['product'=>$saleProduct])
        @endforeach
      </div>
      <button class="glider-prev">&laquo;</button>
      <button class="glider-next">&raquo;</button>
    </div>
  </div>
</section>

<section id="sectionMarques">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-4 col-md-2">
        <img src="{{ asset('images/test/logo1.png') }}">
      </div>
      <div class="col-4 col-md-2">
        <img src="{{ asset('images/test/logo2.png') }}">
      </div>
      <div class="col-4 col-md-2">
        <img src="{{ asset('images/test/logo3.png') }}">
      </div>
      <div class="col-4 col-md-2">
        <img src="{{ asset('images/test/logo4.png') }}">
      </div>
      <div class="col-4 col-md-2">
        <img src="{{ asset('images/test/logo3.png') }}">
      </div>
      <div class="col-4 col-md-2">
        <img src="{{ asset('images/test/logo2.png') }}">
      </div>
    </div>
  </div>
</section>


@endsection

@section('scripts')

<script src="{{ asset('js/glider.js') }}"></script>
<script src="{{ asset('js/gliderFunction.js') }}"></script>
<script>
  window.addEventListener('load',function(){
        $('.productDiv').hide();
        $('#newProduct').show();
        showGlider('#newProduct');
        showGlider('#sectionPromotions');
      });

function showProductDiv(divName){
    $('.productDiv').hide();
    $('#'+divName).show();
    showGlider('#'+divName);

}

function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));
  
  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(div, endtime) {
  // const clock = document.getElementById(id);
  const clock = document.querySelector(div);
  const daysSpan = clock.querySelector('.days');
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    const t = getTimeRemaining(endtime);

    daysSpan.innerHTML = ('0' + t.days).slice(-2);
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}

const deadline = new Date(Date.parse(new Date()) + 2 * 24 * 60 * 60 * 1000);
const deadline2 = new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
initializeClock('.colLeft .clockdiv', deadline);
initializeClock('.colRight .clockdiv', deadline2);
</script>
@endsection