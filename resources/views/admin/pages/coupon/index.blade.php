@extends('admin.layouts.app')
@section('title','Notification')

@section('styles')

<style>

</style>
@endsection

@section('content')
<a href="{{route('admin.coupons.create')}}" class="float-right">
    <button class="au-btn au-btn-icon d-block au-btn--blue">
        <i class="zmdi zmdi-plus"></i>Ajouter
    </button>
</a>

<div id="datatable" class="table-responsive">
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{{$dataTable->scripts()}}
{{-- <script src="{{asset('admin/js/data-table.js')}}"></script> --}}
@endsection