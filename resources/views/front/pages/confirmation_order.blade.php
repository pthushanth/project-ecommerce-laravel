@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>
    .confirmation-commande {
        min-height: 10vh;
    }

    .card {
        max-width: 700px;
        width: 100%;
        margin: 30px auto;
    }

    .card img {
        width: 80px;
        margin: 10px auto 0;
    }
</style>
@endsection

@section('content')
<section id="sectionTitle">
    <h1>Confirmation de la commande</h1>
</section>
<div class="container confirmation-commande">
    @if($order)
    <div class="card border-success mb-3 text-center">
        <img class="card-img-top" src="{{asset('images/tick.png')}}">
        <div class="card-body text-success">
            <h5 class="card-title">Votre commande {{$order->id}} a bien été prise en compte!</h5>
        </div>
    </div>
</div>

@endif

@endsection