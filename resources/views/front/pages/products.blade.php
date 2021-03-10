@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>

</style>
@endsection

@section('content')
<section id="sectionTitle">
  <h1>PRODUITS</h1>
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
              <h5 class="title">Catégories </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">52</span>
                  <input type="checkbox" name="category" class="custom-control-input" id="smartphone">
                  <label class="custom-control-label" for="smartphone">Smartphone</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">132</span>
                  <input type="checkbox" name="category" class="custom-control-input" id="tablette">
                  <label class="custom-control-label" for="tablette">Tablette</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">17</span>
                  <input type="checkbox" name="category" class="custom-control-input" id="televison">
                  <label class="custom-control-label" for="televison">Télévision</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">7</span>
                  <input type="checkbox" name="category" class="custom-control-input" id="montre">
                  <label class="custom-control-label" for="montre">Montre connecté</label>
                </div> <!-- form-check.// -->
              </div> <!-- card-body.// -->
            </div>
          </article>

          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Marques </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">52</span>
                  <input type="checkbox" name="brand" class="custom-control-input" id="samsung">
                  <label class="custom-control-label" for="samsung">Samsung</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">132</span>
                  <input type="checkbox" name="brand" class="custom-control-input" id="apple">
                  <label class="custom-control-label" for="apple">Apple</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">17</span>
                  <input type="checkbox" name="brand" class="custom-control-input" id="sony">
                  <label class="custom-control-label" for="sony">Sony</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">7</span>
                  <input type="checkbox" name="brand" class="custom-control-input" id="autre">
                  <label class="custom-control-label" for="autre">Autre</label>
                </div> <!-- form-check.// -->
              </div> <!-- card-body.// -->
            </div>
          </article>

          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Prix</h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <input type="range" class="custom-range" min="0" max="100" name="">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Min</label>
                    <input type="number" class="form-control" id="inputEmail4" placeholder="$0">
                  </div>
                  <div class="form-group col-md-6 text-right">
                    <label>Max</label>
                    <input type="number" class="form-control" placeholder="$1,0000">
                  </div>
                </div>
              </div> <!-- card-body.// -->
            </div>
          </article> <!-- card-group-item.// -->
          <article class="card-group-item">
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
          </article>
          <article class="card-group-item">
            <header class="card-header">
              <h5 class="title">Rating </h5>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">52</span>
                  <input type="checkbox" name="rating" class="custom-control-input" id="Check1">
                  <label class="custom-control-label" for="Check1">Samsung</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">132</span>
                  <input type="checkbox" name="rating" class="custom-control-input" id="Check2">
                  <label class="custom-control-label" for="Check2">Apple</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">17</span>
                  <input type="checkbox" name="rating" class="custom-control-input" id="Check3">
                  <label class="custom-control-label" for="Check3">Sony</label>
                </div> <!-- form-check.// -->

                <div class="custom-control custom-checkbox">
                  <span class="float-right badge badge-light round">7</span>
                  <input type="checkbox" name="rating" class="custom-control-input" id="Check4">
                  <label class="custom-control-label" for="Check4">Autre</label>
                </div> <!-- form-check.// -->
              </div> <!-- card-body.// -->
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
            <div class="input-group">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Trier</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          @foreach ($products as $product)

          @php $image=$product->image[0]; @endphp
          <div class="col-md-3">
            <a href="{{route('productDetail',$product->slug)}}">
              <div class="card product text-center">
                <img class="card-img-top"
                  src="{{ $image === "noImage.jpg" ? "/storage/$image" : "/storage/product_images/$image" }}">
                <div class="card-body ">
                  <a href="#" class="categorie">{{$product->category->name}} - {{$product->brand->name}}</a>
                  <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="far fa-star"></i>
                  </div>
                  <a href="#" class="produit-titre">{{$product->name}}</a>
                  <p class="prix">{{$product->price}} €</p>
                  <form method="POST" action="{{route('cart.add',$product->slug)}}">
                    @csrf
                    <div class="input-field col">
                      <input type="hidden" id="id" name="id" value="{{ $product->slug }}">
                      <input id="quantity" name="quantity" type="hidden" value="1" min="1">
                      <p>
                        <button class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter au panier</button>
                      </p>
                    </div>
                  </form>

                </div>
              </div>
            </a>

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
</script>
@endsection