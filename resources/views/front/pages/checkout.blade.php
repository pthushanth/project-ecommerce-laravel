@extends('front.app')
@section('title','Accueil')

@section('styles')
<style>
    /**
  Component
**/

    .delivery label {
        width: 100%;
    }

    .card-input-element {
        display: none;
    }

    .card-input {
        margin: 10px;
        padding: 00px;
    }

    .card-input:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 1px 1px #2ecc71;
    }
</style>
@endsection

@section('content')
<section id="sectionTitle">
    <h1>Payment</h1>
</section>

<section id="sectionCheckout">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <form action="{{route('checkout.pay')}}" id="checkout-form" Method="POST" class="billing-form">
                    {{ csrf_field() }}
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                        {{Session::put('error',null)}}
                    </div>
                    @endif
                    <div class="row align-items-end">
                        @if( $deliveryAddresses->count())
                        <div class="col-md-12 delivery">
                            <h5>Veuillez choisir une adresse de livraion </h5>
                            <div class="row">

                                @foreach ($deliveryAddresses as $deliveryAddress)
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" onclick="deleteAdressFields()" class="card-input-element"
                                            name="deliveryAddress" autocomplete="off"
                                            value="{{$deliveryAddress->id}}" />
                                        <div class="card card-input">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ucfirst($deliveryAddress->last_name)." ".ucfirst($deliveryAddress->first_name)}}
                                                </h5>

                                                {{$deliveryAddress->address}} <br>
                                                {{$deliveryAddress->city->post_code." ".ucfirst($deliveryAddress->city->city)}}
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>


                            <span class="btn btn-primary" onclick="createAdressFields()" id="addNewAddress">Ajouter une
                                nouvelle adresse</span>
                            <div id="newAddress"></div>
                        </div>
                        <div class="w-100"></div>
                        @else
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Nom</label>
                                <input type="text" class="form-control" name="firstname" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Prenom</label>
                                <input type="text" class="form-control" name="lastname" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="post-code">Code postale</label>
                                <input type="text" class="form-control" name="post-code" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" class="form-control" name="city" placeholder="">
                            </div>
                        </div>
                        @endif
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="towncity">Nom sur la carte</label>
                                <input type="text" id="card-name" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="postcodezip">Numéro de la carte</label>
                                <input type="text" id="card-number" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone">Expiration mois</label>
                                <input type="text" id="card-expiry-month" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="emailaddress">Expiration année</label>
                                <input type="text" id="card-expiry-year" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">CVC</label>
                                <input type="text" id="card-cvc" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" id="payer" value="Payer">
                            </div>
                        </div>
                    </div>
                </form><!-- END -->
            </div>
            <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="col">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Panier</td>
                                        <td>{{Cart::getTotal()}} €</td>
                                    </tr>
                                    <tr>
                                        <td>Frais de livraion estimé</td>
                                        <td>Gratuit</td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL (TVA inclus)</td>
                                        <td>{{Cart::getTotal()}} €</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>

@endsection

@section('scripts')
{{-- <script type="text/javascript" src="/javascripts/jquery-3.1.1.min.js"></script>  --}}
<script src="https://js.stripe.com/v2/"></script>
<script src="{{asset('js/checkout.js')}}"></script>

<script>
    function createAdressFields(){

        //clear slected address
        const selectedAddress=document.querySelector('input[name=deliveryAddress]:checked')
        if(selectedAddress != null){
            selectedAddress.checked = false;
        }

        //create fileds
        const divNewAddress=  document.getElementById('newAddress')
        divNewAddress.innerHTML=`<div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Nom</label>
                                <input type="text" class="form-control" name="firstname" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Prenom</label>
                                <input type="text" class="form-control" name="lastname" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="post-code">Code postale</label>
                                <input type="text" class="form-control" name="post-code" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" class="form-control" name="city" placeholder="">
                            </div>
                        </div>`;
    }

    function deleteAdressFields(){ 

    //if adresse selected from list then delete new address fields
    document.getElementById('newAddress').innerHTML="";
}
    

</script>
@endsection