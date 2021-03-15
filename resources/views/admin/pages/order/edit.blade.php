@extends('admin.layouts.app')

@section('styles')
@endsection
@section('content')

<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="car mx-auto" style="max-width:800px; width:100%;">
            <div class="card-body">
                <h4 class="card-title">Mettre à jour l'état de la commande</h4>

                {{-- show error or successs message --}}
                @include('admin.includes.error_status')

                <div class="card">
                    <div class="card-header">Mettre à jour l'état de la commande</div>
                    <div class="card-body card-block">
                        <form method="POST" action="{{route('admin.orders.update',$order->id)}}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <div class="col-md-3 input-group-addon">Date de la commande</div>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="{{$order->created_at }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="order-status">Status de la commande</label>
                                <select class="custom-select my-1 mr-sm-2" id="order-status" name="order_status">
                                    @foreach ($orderStatuses as $orderStatus)
                                    <option value="{{$orderStatus->id}}"
                                        {{$orderStatus->id==$order->order_status_id ? 'selected' :''}}>
                                        {{$orderStatus->status}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-actions form-group">
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection