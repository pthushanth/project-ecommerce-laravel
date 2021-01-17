@extends('admin.layouts.app')
    @if(isset($brand))    
        @section('title','Modifier Marque')
        @php
            $titleForm="Modifier une marque";
        @endphp                         
    @else
        @section('title','Ajouter Marque')
        @php
            $titleForm="Ajouter une marque";
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
                            @if(isset($brand))    
                                <form method="POST" action="{{route('admin.brands.update')}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('admin.brands.store')}}" enctype="multipart/form-data">
                            @endif
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Nom de la marque</div>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" value="{{ old('name',$brand->name ?? '') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="imageField">
                                            <div class="col-md-3 input-group-addon">Image</div>

                                            @if (isset($brand->image))
                                                @if($brand->image=="noImage.jpg")
                                                    <img src="{{ '/storage/'.$brand->image }}">
                                                @else
                                                    <img src="{{ '/storage/category_images/'.$brand->image }}">
                                                @endif
                                            @endif

                                            <div class="input-group">
                                                <input type="file" id="image" name="image"class="form-control">
                                            </div>                             
                                        </div>
                                    </div>

                                    <div class="form-actions form-group">
                                        @if(isset($brand))    
                                        <input type="hidden" name="id" value="{{$brand->id}}">
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
