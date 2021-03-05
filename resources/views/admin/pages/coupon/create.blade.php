@extends('admin.layouts.app')
    @if(isset($coupon))    
        @section('title','Modifier Coupon')
        @php
            $titleForm="Modifier un coupon";
        @endphp                         
    @else
        @section('title','Ajouter Coupon')
        @php
            $titleForm="Ajouter un coupon";
        @endphp   
    @endif

@section('styles')
@endsection
@section('content')

        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="car mx-auto" style="max-width:800px; width:100%;">
                    <div class="card-body">
                        <h4 class="card-title">{{ $titleForm }}</h4>
                            {{-- show error or successs message --}}
                            @include('admin.includes.error_status')
                        <div class="card">
                            <div class="card-header">{{ $titleForm }}</div>
                            <div class="card-body card-block">
                            @if(isset($coupon))    
                                <form method="POST" action="{{route('admin.coupons.update')}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('admin.coupons.store')}}" enctype="multipart/form-data">
                            @endif
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Code promo</div>
                                        <div class="input-group">
                                            <input type="text" id="code" name="code" value="{{ old('code',$coupon->code ?? '') }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="percentage"
                                            name="discount_type" value="pourcentage" {{ old('discount_type') == "pourcentage" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="percentage">Pourcentage</label></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="remise" name="discount_type" value="fixed" {{ old('discount_type') == "0" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="remise">Remise</label>
                                    </div>
                                <div class="form-group mt-3">
                                    <div class="col-md-3 input-group-addon">Réduction</div>
                                    <div class="input-group">
                                        <input type="number" id="discount_value" name="discount_value"
                                            value="{{ old('discount_value',$sale->discount_value ?? '') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Date de début</div>
                                        <div class="input-group">
                                            <input type="date" id="start" name="start" value="{{ old('start',$coupon->start ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Date de fin</div>
                                        <div class="input-group">
                                            <input type="date" id="end" name="end" value="{{ old('end',$coupon->end ?? '') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-actions form-group">
                                        @if(isset($coupon))    
                                        <input type="hidden" name="id" value="{{$coupon->id}}">
                                        <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                                        @else
                                        <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>

                                        @endif
                                       
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
