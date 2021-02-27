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

      </div>
      <div class="col-md-9">
        <div class="row">
          @foreach ($products as $product)
          @php $image=$product->image[0]; @endphp
          <div class="col-md-3">
            <a href="{{route('productDetail',$product->id)}}">
              <div class="card product">
                <img class="card-img-top"
                  src="{{ $image === "noImage.jpg" ? "/storage/$image" : "/storage/product_images/$image" }}">
                <div class="card-body text-center">
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
                  <form method="POST" action="{{route('cart.add',$product->id)}}">
                    @csrf
                    <div class="input-field col">
                      <input type="hidden" id="id" name="id" value="{{ $product->id }}">
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