@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>
  #moreCategory,
  #moreBrand {
    display: none;
  }


  /* @media screen and (max-width: 700px) {

    li.page-item {

      display: none;
    }

    .page-item:first-child,
    .page-item:nth-child(1),
    .page-item:nth-last-child(5),
    .page-item:last-child,
    .page-item.active,
    .page-item.disabled {

      display: block;
    }
  } */
</style>


@endsection

@section('content')
{{-- <section id="sectionTitle">
  <h1>PRODUITS</h1>
</section> --}}
<section id="sectionOffres">
  <div class="container-fluid px-0">
    <div class="parallax " style="min-height: 200px">
      <div class="masque">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col" style="margin-top:80px">
              <h1 class="text-center" style="color:#ffffff; text-transform:uppercase;">
                {{isset($pageTitle)? $pageTitle : 'produits'}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<section id="sectionProductList">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        {{-- <h2>FILTRE</h2> --}}
        <form method="GET" action="{{route('products.filter')}}">
          <div class="input-group py-2 mb-3">
            <input class="form-control py-2" type="text" placeholder="search" id="example-search-input" name="search">
            <input type="hidden" value="search" name="type">
            <span class="input-group-append">
              <button class="btn bg-dark text-white" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>

        <div class="card filter">
          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Collections </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <form method="GET" action="{{route('products.filter')}}">
                  <input type="hidden" value="collection" name="type">
                  <div class="custom-control custom-radio">
                    <span class="float-right badge badge-light round">100</span>
                    <input type="radio" name="collection" value="new-products" class="custom-control-input"
                      id="newProducts" {{ old('collection') == "new-products" ? 'checked' : ''}}>
                    <label class="custom-control-label" for="newProducts">Nouveauté</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <span class="float-right badge badge-light round">100</span>
                    <input type="radio" name="collection" value="bestseller-products" class="custom-control-input"
                      id="bestseller" {{ old('collection') == "bestseller-products" ? 'checked' : ''}}>
                    <label class="custom-control-label" for="bestseller">Meilleure ventes</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <span class="float-right badge badge-light round">100</span>
                    <input type="radio" name="collection" value="sale-products" class="custom-control-input"
                      id="promotion" {{ old('collection') == "sale-products" ? 'checked' : ''}}>
                    <label class="custom-control-label" for="promotion">Promotions</label>
                  </div>
                </form>
              </div> <!-- card-body.// -->


            </div>
          </article>

          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Catégories </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <form method="GET" action="{{route('products.filter')}}">
                  <input type="hidden" value="category" name="type">
                  @foreach ($categories as $category)
                  @if($loop->iteration==6)
                  <div id="moreCategory">
                    @endif
                    <div class="custom-control custom-checkbox">
                      <span class="float-right badge badge-light round">{{$category->products->count()}}</span>
                      <input type="checkbox" name="category" value="{{$category->id}}" class="custom-control-input"
                        id="{{$category->name}}">
                      <label class="custom-control-label" for="{{$category->name}}">{{$category->name}}</label>
                    </div>
                    @if($loop->iteration>=6 &&$loop->last)
                  </div>
                  @endif
                  @endforeach
                </form>
                <button type="button" onclick="ShowMore('moreCategory','btnShowMoreCategory')"
                  class="btn btn-outline-primary btnShowMoreCategory">voir
                  plus</button>
              </div> <!-- card-body.// -->


            </div>
          </article>

          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Marques </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <form method="GET" action="{{route('products.filter')}}">
                  <input type="hidden" value="brand" name="type">
                  @foreach ($brands as $brand)
                  @if($loop->iteration==6)
                  <div id="moreBrand">
                    @endif
                    <div class="custom-control custom-checkbox">
                      <span class="float-right badge badge-light round">{{$brand->products->count()}}</span>
                      <input type="checkbox" name="brand" value="{{$brand->id}}" class="custom-control-input"
                        id="{{$brand->name}}">
                      <label class="custom-control-label" for="{{$brand->name}}">{{$brand->name}}</label>
                    </div>
                    @if($loop->iteration>=6 &&$loop->last)
                  </div>
                  @endif
                  @endforeach
                </form>
                <button type="button" onclick="ShowMore('moreBrand','btnShowMoreBrand')"
                  class="btn btn-outline-primary btnShowMoreBrand">voir
                  plus</button>
              </div><!-- card-body.// -->
            </div>
          </article>

          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Prix</h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <form method="GET" action="{{route('products.filter')}}">
                  @csrf
                  <input type="hidden" value="price" name="type">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <input type="range" class="custom-range" min="0" max="100" name="">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Min</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="min" placeholder="1">
                        <div class="input-group-append">
                          <span class="input-group-text">€</span>
                        </div>
                      </div>

                    </div>
                    <div class="form-group col-md-6 text-right">
                      <label>Max</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="max" placeholder="1000">
                        <div class="input-group-append">
                          <span class="input-group-text">€</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-outline-primary">Filtrer</button>
                </form>
              </div> <!-- card-body.// -->
            </div>
          </article> <!-- card-group-item.// -->
          {{-- <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Couleur</h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="color" class="custom-control-input" id="Check1">
                  <label class="custom-control-label" for="Check1"><span class="fa fa-circle pr-1"
                      id="red"></span>rouge</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="color" class="custom-control-input" id="Check1">
                  <label class="custom-control-label" for="Check1"><span class="fa fa-circle pr-1"
                      id="teal"></span>vert</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="color" class="custom-control-input" id="Check1">
                  <label class="custom-control-label" for="Check1"><span class="fa fa-circle pr-1"
                      id="blue"></span>bleu</label>
                </div>

              </div> <!-- card-body.// -->
            </div>
          </article> --}}
          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Rating </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                {{-- {{dd($ratings)}} --}}
                @foreach ($reviews as $review)
                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">{{$review->totalProducts}}</span>
                  <input type="checkbox" name="review" class="custom-control-input" id="{{$review->rating}}">
                  <label class="custom-control-label" for="{{$review->rating}}">{{$review->rating}}</label>
                </div>
                @endforeach
              </div><!-- card-body.// -->
            </div>
          </article>
          <!-- card-group-item.// -->
        </div> <!-- card.// -->

      </div>
      <div class="col-md-9">

        <div class="row justify-content-center py-2 mb-3" style="background-color: #fff">
          <div class="col">
            <span>{{$products->total()}} produits</span>
          </div>
          <div class="col">
            {{-- <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Trier</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div> --}}
          </div>
        </div>
        <div class="row justify-content-center">

          @foreach ($products as $product)
          <div class="col-md-3">
            @include('front.includes.product_card',['product'=>$product])
          </div>
          @endforeach
        </div>
        {{-- pagination --}}
        <div class="d-flex justify-content-center">
          {!! $products->links() !!}
        </div>
      </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
  @if(session()->has('cart'))
    document.addEventListener('DOMContentLoaded', () => {      
      const instance = M.Modal.init(document.querySelector('.modal'));
      instance.open();    
    });
  @endif    

  //more filter
function ShowMore(div,btn) {
  var divShowMore= document.getElementById(div);
  var btnText = document.querySelector("."+btn);

  if (divShowMore.style.display === "inline") {
    btnText.innerHTML = "voir moins"; 
    divShowMore.style.display = "none";

  } else {
    btnText.innerHTML = "voir plus"; 
    divShowMore.style.display = "inline";
  }
}

//radio filter to submit 
$('input[type=radio]').on('change', function() {
    $(this).closest("form").submit();
});
$('input[type=checkbox]').on('change', function() {
    $(this).closest("form").submit();
});
</script>
@endsection