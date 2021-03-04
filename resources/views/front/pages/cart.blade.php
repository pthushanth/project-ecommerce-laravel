@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>

</style>
@endsection

@section('content')
<section id="sectionTitle">
  <h1>mon panier</h1>
</section>

<section id="sectionCart">
  <div class="container-fluid">
    <div class="row">
      @if(!Cart::isEmpty())
      <div class="col-md-8 px-4">
        <p class="sous-titre">Détail de mon panier</p>
        <div class="row ">
          <div class="card">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Produit</th>
                  <th scope="col">Prix</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Total</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach (Cart::getContent() as $item)
                <tr>
                  <th>
                    <div class="d-inline-block align-middle">
                      <img src="{{$item->model->getThumbnailUrl()}}" class="card-img" style="width: 100px">
                    </div>
                    <div class="d-inline-block align-middle">
                      <h5 class="produit-titre">{{$item->name}}</h5>
                      <p class="categorie">{{$item->model->category->name}} - {{$item->model->brand->name}}</p>
                    </div>
                  </th>
                  <td>
                    <p class="prix">{{$item->model->price}} €</p>
                  </td>
                  <td>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input name="quantity" type="number" min="1" value="{{ $item->quantity }}" class="form-control"
                        style="width:70px">

                      <button class="btn btn-secondary" type="submit">modifier</button>
                    </form>
                  </td>

                  <td>
                    <p class="prix">{{ number_format($item->quantity * $item->price, 2, ',', ' ') }} €</p>
                  </td>
                  <td>
                    <a title="" href="" class="btn btn-outline-success" data-toggle="tooltip"
                      data-original-title="Save to Wishlist"> <i class="fa fa-heart"></i></a>
                    <form action="{{ route('cart.delete_item', $item->id) }}" method="POST" class="d-inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger"><i class="fas fa-times"></i> </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4 px-4">
        <p class="sous-titre">Récapitulaif</p>
        <div class="row code-promo">
          <div class="col-12 justify-content-center">
            <form action="{{ route('cart.coupon') }}" method="POST">
              @csrf
              <p>Code promo</p>
              <div class="form-group row ">
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Ecrivez ici" name="coupon">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    {{Session::get('success')}}
                  </div>
                  @endif
                  @if(Session::has('fail'))
                  <div class="alert alert-danger">
                    {{Session::get('fail')}}
                  </div>
                  @endif

            </form>

          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary mb-2">Valider</button>
          </div>
        </div>
        </form>
      </div>
    </div>

    <div class="row valider-panier mt-5">
      <div class="col">
        <table class="table">
          <tbody>
            <tr>
              <td>Panier</td>
              <td>@if(!Cart::isEmpty()) {{Cart::getSubTotal().' €'}} @endif </td>
            </tr>
            <tr>
              <td>Frais de livraion estimé</td>
              <td>Gratuit</td>
            </tr>
            @if(Cart::getConditions()->first())
            {{-- {{dd(Cart::getConditions())}} --}}
            <tr>
              <td>Code promo ({{Cart::getConditions()->first()->getName()}})</td>
              @php $discount= Cart::getConditions()->first()->getCalculatedValue(Cart::getSubTotal()).' €' @endphp
              <td>{{'- '.$discount}}</td>
            </tr>
            @endif
            <tr>
              <td>TOTAL (TVA inclus)</td>
              <td>@if(!Cart::isEmpty()) {{Cart::getTotal().' €'}} @endif <br>
                @if(Cart::getConditions()->first()) <span style="color:rgb(9, 173, 9)"> Vous économisez
                  <strong>{{$discount}}</strong></span> @endif
              </td>
            </tr>
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          <a class="btn btn-primary" href="{{ route('checkout') }}"> Valider mon panier</a>
        </div>
      </div>
    </div>
    {{-- {{Cart::getContent()}}
    {{dd(Cart::getCondition('coupon'))}} --}}
    {{-- @if(isset($newTotal)){{dd($newTotal)}}@endif --}}

  </div>
  @else
  <div class="col px-5 text-center">
    <h2>Panier est vide</h2>
  </div>
  @endif
  </div>
  </div>
</section>
@endsection

@section('scripts')
{{-- <script>
  $(document).ready(function() {
 $('.product-icon-container').find('a.scrollOffset').click(function (event){
   event.preventDefault();
   $.ajax({
      url: $(this).attr('href')
   });
  return false;
 });
});
</script> --}}
@endsection



{{-- <span class="card-title">Mon panier</span>            
           
            <hr><br>
            <div class="row" style="background-color: lightgrey">
              <div class="col s6">
                Total TTC (hors livraison)
              </div>
              <div class="col s6">
                <strong>{{ number_format(Cart::getTotal(), 2, ',', ' ') }} €</strong>
</div>
</div>
@else
<span class="card-title center-align">Le panier est vide</span> --}}




{{-- <div id="loader" class="hide">
          <div class="loader"></div>
        </div> --}}



{{-- <div id="action" class="card-action">
        <p>
          <a  href="{{ route('home') }}">Continuer mes achats</a>
@if(Cart::getTotal())
<a href="#">Commander</a>
@endif
</p>
</div> --}}