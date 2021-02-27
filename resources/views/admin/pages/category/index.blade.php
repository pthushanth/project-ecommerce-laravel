@extends('admin.layouts.app')
@section('title','Catégories')


@section('styles')

{{-- <style>
#datatable tbody td {
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
</style> --}}
@endsection

@section('content')
<a href="{{route('admin.categories.create')}}" class="float-right">
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