{{-- @if($product->price==1400) {{dd($product->productSale->discount_value)}}@endif --}}
@if($product->isOnSale())
<div class="card product text-center h-100">
    <a href="{{route('productDetail',$product->slug)}}">
        <div class="image">
            <div class="solde-reduction">
                <span class="solde">BON PLAN</span>
                <span class="reduction">{{$product->productSale->discount_value}}</span>
            </div>
            <img class="card-img-top" src="{{ asset($product->getThumbnailUrl()) }}">
        </div>

        <div class="card-body text-center d-flex flex-column">
            <a href="#" class="categorie">{{$product->category->name}} -
                {{$product->brand->name}}</a>
            <div class="rating">
                {!! $product->printAverageRatingStar() !!}
            </div>
            <a href="#" class="produit-titre">{{$product->name}}</a>
            <p class="prix">{!!$product->printPrice()!!}</p>
            <form method="POST" action="{{route('cart.add',$product->slug)}}" class="mt-auto">
                @csrf
                <div class="input-field col">
                    <input type="hidden" id="id" name="id" value="{{ $product->slug }}">
                    <input id="quantity" name="quantity" type="hidden" value="1" min="1">
                    <p>
                        <button class="btn btn-cart"><i class="fas fa-shopping-bag"></i> Ajouter au panier</button>
                    </p>
                </div>
            </form>
        </div>
    </a>
</div>
@else

<div class="card product text-center h-100">
    <a href="{{route('productDetail',$product->slug)}}">
        <img class="card-img-top" src="{{ asset($product->getThumbnailUrl()) }}">
        <div class="card-body text-center d-flex flex-column">
            <a href="#" class="categorie">{{$product->category->name}} -
                {{$product->brand->name}}</a>
            <div class="rating">
                {!! $product->printAverageRatingStar() !!}
            </div>
            <a href="#" class="produit-titre">{{$product->name}}</a>
            <p class="prix">{!!$product->printPrice()!!}</p>
            <form method="POST" action="{{route('cart.add',$product->slug)}}" class="mt-auto">
                @csrf
                <div class="input-field col">
                    <input type="hidden" id="id" name="id" value="{{ $product->slug }}">
                    <input id="quantity" name="quantity" type="hidden" value="1" min="1">
                    <p>
                        <button class="btn btn-cart"><i class="fas fa-shopping-bag"></i> Ajouter au panier</button>
                    </p>
                </div>
            </form>
        </div>
    </a>
</div>

@endif