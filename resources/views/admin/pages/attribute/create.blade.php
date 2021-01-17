@extends('admin.layouts.app')
    @if(isset($attribute))    
        @section('title','Modifier un Attribut')
        @php
            $titleForm="Modifier un attribut";
        @endphp                         
    @else
        @section('title','Ajouter Attribut')
        @php
            $titleForm="Ajouter un attribut";
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
                            @if(isset($attribute))    
                                <form method="POST" action="{{route('admin.attributes.update')}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('admin.attributes.store')}}" enctype="multipart/form-data">
                            @endif
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Nom de l'attribut</div>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" value="{{ old('name',$attribute->name ?? '') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-actions form-group">
                                        @if(isset($attribute))    
                                        <input type="hidden" name="id" value="{{$attribute->id}}">
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
