@extends('admin.layouts.app')
@section('title','Marques')

@section('styles')


@endsection

@section('content')
    <div  id="datatable" class="table-responsive"> 
    </div>
@endsection

@section('scripts')
<script src="{{asset('admin/js/data-table.js')}}"></script>
@endsection
