@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>

</style>
@endsection

@section('content')
<section id="sectionTitle">
    <h1>PRODUIT DETAIL</h1>
</section>

<div id="pageProductDetail">
    <section id="sectionProductDetail">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 image-gallery">
                    <div class="row">
                        <img src="{{asset('images/test/apple_watch.png')}}" id="ProductImg">
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset('images/test/iphone12.jpg')}}" class="small-img">
                        </div>
                        <div class="col-3">
                            <img src="{{asset('images/test/apple_watch.png')}}" class="small-img">
                        </div>
                        <div class="col-3">
                            <img src="{{asset('images/test/s20.jpg')}}" class="small-img">
                        </div>
                        <div class="col-3">
                            <img src="{{asset('images/test/apple_watch.png')}}" class="small-img">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <p class="product-title">Samsung Galaxy S20</p>
                    <hr>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p class="product-price">500.00€</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent egestas volutpat libero, vitae
                        dictum
                        ligula posuere sed. Praesent at ultricies urna. Quisque euismod enim ipsum, at tempor erat
                        tempor
                        eget
                    </p>

                    <div class="row mt-5 justify-content-center">
                        <form method="POST" action="{{route('cart.add',$product->id)}}">
                            @csrf
                            <div class="input-field col">
                                <input type="hidden" id="id" name="id" value="{{ $product->id }}">
                                <input id="quantity" name="quantity" type="hidden" value="1" min="1">
                                <p>
                                    <button class="btn ajouterPanier"><i class="fas fa-shopping-bag"></i> Ajouter au
                                        panier</button>
                                </p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section>
        <div class="container text-center">
            <div id="description" class="mb-5">
                <h2>Description</h2>
                <p>
                    {!!$product->long_description!!}
                </p>
            </div>
            <div id="description" class="mb-5">
                <h2>Détail produit</h2>
                <table class="table table-striped">
                    @foreach ($product->attributes as $attribut)
                    <tr>
                        <td>{!!$attribut->name!!}</td>
                        <td>{!!$attribut->pivot->value!!}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
            <div id="description" class="mb-5">
                <h2>Review</h2>
                @foreach ($product->reviews as $review)
                <p>
                    <span> {!!$review->user->name!!} </span>
                    <span class="text-muted"> {!!$review->review!!} </span> <br>
                    <span class="text-muted"> {!!$review->created_at!!} </span>
                </p>
                @endforeach
            </div>
        </div>

    </section>
    <section>
        <div class="container text-center">
            <h2>Nous vous recommandons</h2>

            <div class="row">

                @foreach ($product->category->relatedProducts as $product)

                @php
                // $product=$product->product;
                $image=$product->image[0];
                @endphp
                <div class="col-md-3">
                    <a href="{{route('productDetail',$product->id)}}">
                        <div class="card product">
                            <img class="card-img-top"
                                src="{{ $image === "noImage.jpg" ? "/storage/$image" : "/storage/product_images/$image" }}">
                            <div class="card-body text-center">
                                <a href="#" class="categorie">{{$product->category->name}} -
                                    {{$product->brand->name}}</a>
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
                                            <button class="btn btn-primary"><i class="fas fa-shopping-bag"></i> Ajouter
                                                au panier</button>
                                        </p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </a>

                </div>
                @endforeach
            </div>

    </section>
</div>
@endsection

@section('scripts')
<script>
    /****************    Js for product gallery  *******************/

    var ProductImg=document.getElementById("ProductImg");
        var SmallImg= document.getElementsByClassName("small-img");
        SmallImg[0].onclick=function(){
            ProductImg.src=SmallImg[0].src;
        }
        SmallImg[1].onclick=function(){
            ProductImg.src=SmallImg[1].src;
        }
        SmallImg[2].onclick=function(){
            ProductImg.src=SmallImg[2].src;
        }
        SmallImg[3].onclick=function(){
            ProductImg.src=SmallImg[3].src;
        }
</script>
<script>
    @if(session()->has('cart'))
    document.addEventListener('DOMContentLoaded', () => {      
      const instance = M.Modal.init(document.querySelector('.modal'));
      instance.open();    
    });
  @endif    
</script>
@endsection