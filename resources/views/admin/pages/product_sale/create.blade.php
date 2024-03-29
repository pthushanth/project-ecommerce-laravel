@extends('admin.layouts.app')
@if(isset($sale))
@section('title','Modifier Promotion')
@php
$titleForm="Modifier une Promotion";
@endphp
@else
@section('title','Ajouter Promotion')
@php
$titleForm="Ajouter une Promotion";
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
                        @if(isset($sale))
                        <form method="POST" action="{{route('admin.product_sales.update',$sale->id)}}">
                            @method('PUT')
                            @else
                            <form method="POST" action="{{route('admin.product_sales.store')}}">
                                @endif
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-3 input-group-addon">Products</div>
                                    <select id="products" name="products[]" class="form-control" multiple>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="percentage"
                                            name="is_percentage" value="1"
                                            {{ old('is_percentage') == "1" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="percentage">Pourcentage</label></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="remise" name="is_percentage"
                                            value="0" {{ old('is_percentage') == "0" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="remise">Remise</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 input-group-addon">Réduction</div>
                                    <div class="input-group">
                                        <input type="number" id="discount_value" name="discount_value"
                                            value="{{ old('discount_value',$sale->discount_value ?? '') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3 input-group-addon">Debut</div>
                                    <div class="input-group">
                                        <input type="date" id="start" name="start"
                                            value="{{ old('start',$sale->start ?? '') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 input-group-addon">Fin</div>
                                    <div class="input-group">
                                        <input type="date" id="end" name="end" value="{{ old('end',$sale->end ?? '') }}"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="form-actions form-group">
                                    @if(isset($sale))
                                    <input type="hidden" name="id" value="{{$sale->id}}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
{{-- <script>
    $('#products').select2({
        placeholder: "Choissiez produits",
        minimumInputLength: 2,
        ajax: {
            url: '{{route("admin.products.findAutocomplete")}}',
dataType: 'json',
data: function (params) {
return {
q: $.trim(params.term)
};
},
processResults: function (data) {
return {
results: data
};
},
cache: true
}
});
</script> --}}

<script type="text/javascript">
    $('#products').select2({
      placeholder: 'Select an item',
      ajax: {
        url: '{{route("admin.products.findAutocomplete")}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.name,
                      id: item.slug,
                    //   id: item.id,
                  }
              })
          };
        },
        cache: true
      }
    });
</script>

@endsection