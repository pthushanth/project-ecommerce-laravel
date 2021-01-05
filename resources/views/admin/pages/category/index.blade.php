@extends('admin.layouts.app')
@section('title','Catégories')
<style>
tbody td {
    word-break: break-word !important;
    vertical-align: top;
}
#datatable{
    padding: 10px;
}
#datatable img{
    height:100px;
}
.table.dataTable {
    width: 100% !important;
}
</style>

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

@endsection

@section('content')
    <div id="datatable" class="table-responsive"> 
        {!! $dataTable->table() !!}
    </div>
@endsection

@section('scripts')
{{$dataTable->scripts()}}
{{-- <script src="{{asset('admin/js/data-table.js')}}"></script> --}}
@endsection
