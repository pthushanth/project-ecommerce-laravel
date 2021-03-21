<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: center;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>TechZone</h2>
                            </td>

                            <td>
                                Invoice #: {{$order->id}}<br>
                                Date de facturation: {{$order->created_at}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h5>Information Client</h5>
                                <strong> {{$order->deliveryAddress->title}} . {{$order->deliveryAddress->first_name}}
                                    {{$order->deliveryAddress->last_name}}</strong> <br>
                                {{$order->deliveryAddress->address}} <br>
                                {{$order->deliveryAddress->city->post_code}} {{$order->deliveryAddress->city->city}}
                            </td>
                            <td>
                                <h5>Facturation</h5>
                                <p>{{$order->deliveryAddress->title}} . {{$order->deliveryAddress->first_name}}
                                    {{$order->deliveryAddress->last_name}}</p>

                                <p> {{$order->deliveryAddress->address}} <br>
                                    {{$order->deliveryAddress->city->post_code}} {{$order->deliveryAddress->city->city}}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <table>
                <tr class="heading">
                    <td>
                        Produit
                    </td>
                    <td>
                        Quantité
                    </td>
                    <td>
                        Prix
                    </td>
                    <td>
                        Total
                    </td>
                </tr>

                @foreach ($order->products as $product)
                <tr class="item">
                    <td>{{$product->name}}</td>
                    <td>{{$product->pivot->qty}}</td>
                    <td>{{$product->printPrice()}}</td>
                    <td>{{$product->price*$product->pivot->qty}} €</td>
                </tr>
                @endforeach

                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        Total: {{$order->amount}} €
                    </td>
                </tr>

            </table>
        </table>
    </div>

</body>

</html>



{{-- 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Raleway:300i,400,500,700&display=swap');

        body {
            padding: 0;
            margin: 0;
            overflow-x: hidden;
            font-family: 'Raleway', sans-serif;
        }

        h5,
        h3 {
            text-transform: capitalize;
        }

        img {
            max-width: 20%;
        }

        .b-t {
            border-top: 1px solid #ddd;
        }

        @media(max-width: 768px) {
            .text-right {
                text-align: center !important;
            }

            .pull-right {
                float: none;
                text-align: center;
            }

            .center {
                text-align: center;
            }

            .bg-light.p-5:nth-child(1) {
                padding: 1rem !important;
            }

            img {
                max-width: 30%;
                margin: 0 auto;
                display: block;
            }

            .p-5 {
                padding: 1rem !important;
            }

            .text-right h5:nth-child(3) {
                padding-top: 15px !important;
            }

            .pt-5 {
                padding-top: 1rem !important
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="bg-light p-5">
            <h1 class="text-center m-0">Facture</h1>
            <div class="row pt-3 mb-2">
                <div class="col-md-6 pull-left"><img src="{{asset('images/logo.png')}}" class="img-responsive"></div>
<div class="col-md-6 text-right">
    <h5 class="pt-4">Facture #{{$order->id}}</h5>
    <p class="text-muted mb-0"><i>Date de facturation :{{$order->created_at}}</i></p>
</div>
</div>
<div class="row b-t pt-5">
    <div class="col-md-6 pt-3 center">
        <h5>Information Client</h5>
        <p>{{$order->user->title}} . {{$order->user->first_name}}
            {{$order->user->last_name}}</p>
        <p> {{$order->deliveryAddress->city->post_code}} {{$order->deliveryAddress->city->city}}</p>
    </div>
    <div class="col-md-6 text-right">
        <h5>Facturation</h5>
        <p>{{$order->deliveryAddress->title}} . {{$order->deliveryAddress->first_name}}
            {{$order->deliveryAddress->last_name}}</p>
        <p> {{$order->deliveryAddress->city->post_code}} {{$order->deliveryAddress->city->city}}</p>
    </div>
</div>
<table class="table">
    <tr>
        <thead>
            <td>Produit</td>
            <td>Quantité</td>
            <td>Prix</td>
            <td>Total</td>
        </thead>
    </tr>
    @foreach ($order->products as $product)
    <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->pivot->qty}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->price*$product->pivot->qty}}</td>
    </tr>
    @endforeach
</table>
</div>
<div class="bg-dark text-white p-5">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-3 text-right">
            <h6>Sub - Total amount</h6>
            <h3 class="text-center">{{$order->amount}}</h3>
        </div>
        <div class="col-md-2 text-right">
            <h6>Discount</h6>
            <h3></h3>
        </div>
        <div class="col-md-3 text-right">
            <h6>Grand Total</h6>
            <h3>{{$order->amount}}</h3>
        </div>
    </div>
</div>
</div>
</body>

</html> --}}