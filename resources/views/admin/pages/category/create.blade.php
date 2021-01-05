@extends('admin.layouts.app')
    @if(isset($category))    
        @section('title','Modifier Catégorie')
        @php
            $titleForm="Modifier une catégorie";
        @endphp                         
    @else
        @section('title','Ajouter Catégorie')
        @php
            $titleForm="Ajouter une catégorie";
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
                        @if(Session::has('status'))
                            <div class="alert alert-success">
                                {{Session::get('status')}}
                            </div>
                        @endif

                        @if(count($errors)>0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{$error}}
                                    </div>
                                @endforeach
                        @endif
                        <div class="card">
                            <div class="card-header">{{ $titleForm }}</div>
                            <div class="card-body card-block">
                            @if(isset($category))    
                                <form method="POST" action="{{route('admin.categories.update')}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
                            @endif
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Nom de la catégorie</div>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" value="{{ old('name',$category->name ?? '') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="imageField">
                                            <div class="col-md-3 input-group-addon">Image</div>

                                            @if (isset($category->image))
                                                @if($category->image=="noImage.jpg")
                                                    <img src="{{ '/storage/'.$category->image }}">
                                                @else
                                                    <img src="{{ '/storage/category_images/'.$category->image }}">
                                                @endif
                                            @endif

                                            <div class="input-group">
                                                <input type="file" id="image" name="image"class="form-control">
                                            </div>                             
                                        </div>
                                    </div>

                                    <div class="form-actions form-group">
                                        @if(isset($category))    
                                        <input type="hidden" name="id" value="{{$category->id}}">
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
