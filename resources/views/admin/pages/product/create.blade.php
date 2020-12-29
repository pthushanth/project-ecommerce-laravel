@extends('admin.layouts.app')
@section('title','Ajouter Produits')

@section('content')

        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
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
                            <div class="card-header">Example Form</div>
                            <div class="card-body card-block">
                                
                                <form method="POST" action="{{route('admin.store_product')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Nom du produit</div>
                                            <input type="text" id="product_name" name="product_name" class="form-control">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Prix du produit</div>
                                            <input type="text" id="product_price" name="product_price" class="form-control">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Catégorie du produit</div>
                                            <select name="product_category" id="product_category" class="form-control">
                                                <option value="0">Please select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Description court</div>
                                            <textarea name="short_description" id="short_description" rows="4" placeholder="Description" class="form-control"></textarea>

                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Description long</div>
                                            <textarea name="long_description" id="long_description" rows="8" placeholder="Description long" class="form-control"></textarea>

                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Caractéristique</div>
                                            <textarea name="spec" id="spec" rows="8" placeholder="Caractéristique" class="form-control"></textarea>

                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Image</div>
                                            <input type="file" id="product_image" name="product_image" multiple="" class="form-control">
                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                        </div>
                                        
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
    {{-- <script src="{{asset('backend/js/form-validation.js')}}"></script>
    <script src="{{asset('backend/js/bt-maxLength.js')}}"></script> --}}
@endsection
