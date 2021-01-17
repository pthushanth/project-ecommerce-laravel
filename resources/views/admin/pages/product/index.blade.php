@extends('admin.layouts.app')
@section('title','Ajouter Produits')

@section('styles')


@endsection

@section('content')
    <div id="datatable"  class="table-responsive"> 
        {!! $dataTable->table() !!}
    </div>
@endsection

@section('scripts')
{{$dataTable->scripts()}}
{{-- <script src="{{asset('admin/js/data-table.js')}}"></script> --}}
@endsection
