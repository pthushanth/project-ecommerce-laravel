@extends('admin.layouts.app')
@section('title','Ajouter Produits')
<style>
tbody td {
    word-break: break-word !important;
    vertical-align: top;
}
.dt-responsive{
    width:100%;
}
</style>

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

@endsection

@section('content')
    <div class="table-responsive"> 
        {!! $dataTable->table() !!}
    </div>
@endsection

@section('scripts')
{{$dataTable->scripts()}}
{{-- <script src="{{asset('admin/js/data-table.js')}}"></script> --}}
@endsection
