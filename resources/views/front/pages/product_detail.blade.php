@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>
    body {
        background-color: #eee
    }

    div.stars {
        width: 270px;
        display: inline-block
    }

    .mt-200 {
        margin-top: 200px
    }

    input.star {
        display: none
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #4A148C;
        transition: all .2s
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952
    }

    input.star-1:checked~label.star:before {
        color: #F62
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3)
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome
    }

    /* Modal */
    .modal-header {
        background-color: #000000;
        color: #ffffff;
    }

    .modal-header .close {
        color: #ffffff;
    }

    /*  review  */
    .card-review {
        max-width: 800px;
        margin: 0 auto;
    }

    .card-review .profile-pic {
        width: 70px;
        height: 70px;
        border-radius: 100%;

    }
</style>
@endsection

@section('content')
{{-- <section id="sectionTitle">
    <h1>PRODUIT DETAIL</h1>
</section> --}}

<div id="pageProductDetail">
    <section id="sectionProductDetail">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 image-gallery">
                    <div class="row">
                        <img src="{{asset($product->getThumbnailUrl())}}" id="ProductImg">
                    </div>

                    <div class="row">
                        @foreach ( $product->image as $image)
                            <div class="col-3">
                                    <img src="{{asset($product->getImageUrl($image))}}" class="small-img">
                                </div>  
                        @endforeach
                    </div>
                </div>
                <div class="col-md-7">
                    <p class="product-title">{{$product->name}}</p>
                    <hr>
                    <div class="rating">
                        {!! $product->printAverageRatingStar() !!}
                    </div>
                    <p class="product-price">{{$product->price}}</p>
                    <p>{!!$product->short_description!!}</p>

                    <div class="row mt-5 justify-content-center">
                        <form method="POST" action="{{route('cart.add',$product->slug)}}">
                            @csrf
                            <div class="input-field col">
                                <input type="hidden" id="id" name="slug" value="{{ $product->slug }}">
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
                @if(Auth::user() && $product->currentUserCanReview())
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal">
                    Donner votre avis
                </button>

                <!-- Modal -->
                <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">DONNER VOTRE AVIS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('client.review.store',$product->slug)}}" method="POST">
                                    @csrf
                                    <div class="stars">
                                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
                                        <label class="star star-1" for="star-1"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="review">Votre avis</label>
                                        <textarea class="form-control" id="review" rows="3" name="review"></textarea>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                @endif
                @foreach ($product->reviews as $review)
                <div class="card card-review">
                    <div class="card-body py-1">
                        <div class="row">
                            <div class="col-sm-3">
                                <img class="profile-pic" src="{{asset($review->user->getAvatarUrl())}}">
                                <h5 class="mt-2 mb-0">{{$review->user->name}}</h5>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="review">{{$review->review}}</p>
                                    </div>
                                    <div class="col-md-3 rating ml-right">
                                        {!!$review->printRatingStar()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right ">
                            <p class="text-muted mb-0">{{$review->created_at}}</p>
                        </div>
                    </div>

                </div>

            </div>
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

<script>

</script>
@endsection