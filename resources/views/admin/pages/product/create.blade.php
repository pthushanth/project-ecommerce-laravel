@extends('admin.layouts.app')
@section('title','Ajouter Produits')

@section('styles')
@endsection
@section('content')
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="car mx-auto" style="max-width:800px; width:100%;">
                    <div class="card-body">
                        <h4 class="card-title">Ajouter Produits</h4>
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
                            <div class="card-header">Ajouter un produit</div>
                            <div class="card-body card-block">
                                
                                <form method="POST" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Nom du produit</div>
                                        <div class="input-group">
                                            <input type="text" id="product_name" name="product_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Prix du produit</div>
                                        <div class="input-group">
                                            <input type="text" id="product_price" name="product_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Catégorie du produit</div>
                                        <div class="input-group">
                                            <select name="product_category" id="product_category" class="form-control">
                                                <option value="0">Please select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Marque du produit</div>
                                        <div class="input-group">
                                            <select name="product_brand" id="product_brand" class="form-control">
                                                <option value="0">Please select</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Description court</div>
                                        <div class="input-group">
                                            <textarea name="short_description" id="short_description" rows="4" placeholder="Description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Description long</div>
                                        <div class="input-group">
                                            <textarea name="long_description" id="long_description" rows="8" placeholder="Description long" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="specField">
                                            <div class="col-md-3 input-group-addon">Caractéristique</div>
                                            <div class="input-group">
                                                <input type="text"  name="specName[]" placeholder="attribue" class="form-control">
                                                <input type="text"  name="specValue[]" placeholder="valeur" class="form-control">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="cloneField('specField','input-group')">
                                            <i class="fa fa-plus"></i> Ajouter Caractéristique
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <div id="imageField">
                                            <div class="col-md-3 input-group-addon">Image</div>
                                            <div class="input-group">
                                                <input type="file" id="product_image" name="product_image[]" multiple="" class="form-control">
                                            </div>
                                            
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="cloneField('imageField','input-group')">
                                                <i class="fa fa-plus"></i> Ajouter une autre image
                                        </button>
                                    </div>

                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
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
    <script>
        function cloneField(idField,classtoClone){
        
            // clone at the end 
            // but it will duplicate the values of the input so after insert find and reset values ofthe input
            $('#'+idField+' .'+classtoClone+':last').clone().appendTo('#'+idField).find("input").val("").end();
        }
      
    </script>
    
@endsection
