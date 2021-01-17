@extends('admin.layouts.app') 
        @section('title','Modifier Produit')
        @php
            $titleForm="Modifier un produit";
    @endphp                      


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
                                    <form method="POST" action="{{route('admin.products.update')}}" enctype="multipart/form-data">
                                    @method('PUT')

                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Nom du produit</div>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" value="{{ old('name',$product->name) }}" class="form-control @error('name') is-invalid @enderror">
                                        </div>
                                         @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Prix du produit</div>
                                        <div class="input-group">
                                            <input type="text" id="price" name="price" value="{{ old('name',$product->price) }}"class="form-control @error('price') is-invalid @enderror">
                                        </div>
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Catégorie du produit</div>
                                        <div class="input-group">
                                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                                <option value="0">Please select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ||  $product->category->id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Marque du produit</div>
                                        <div class="input-group">
                                            <select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror">
                                                <option value="0">Please select</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ||  $product->brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('brand')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Attribut du produit</div>
                                        <div class="input-group">
                                            <select name="attribute" id="attribute" class="form-control @error('attribute') is-invalid @enderror">
                                                <option value="0">Please select</option>
                                                @foreach($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                @endforeach
                                            </select>

                                            <button type="button" class="btn btn-secondary btn-sm" onclick="AddAttributField()">
                                                <i class="fa fa-plus"></i> Ajouter attribut
                                            </button>
                                        </div>
                                        @error('attribute')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="attributField"></div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Description court</div>
                                        <div class="input-group">
                                            <textarea name="short_description" id="short_description" rows="4" placeholder="Description" class="form-control @error('short_description') is-invalid @enderror">
                                                {{ old('short_description',$product->short_description) }}
                                            </textarea>
                                        </div>
                                        @error('short_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Description long</div>
                                        <div class="input-group">
                                            <textarea name="long_description" id="long_description" rows="8" placeholder="Description long" class="form-control @error('long_description') is-invalid @enderror">
                                                {{ old('long_description',$product->long_description) }}
                                            </textarea>
                                        </div>
                                        @error('short_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <div id="specField">
                                            <div class="col-md-3 input-group-addon">Caractéristique</div>
                                            <div class="input-group">
                                                <input type="text"  name="specName[]" placeholder="attribue" class="form-control @error('specName') is-invalid @enderror">
                                                <input type="text"  name="specValue[]" placeholder="valeur" class="form-control @error('specValue') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="cloneField('specField','input-group')">
                                            <i class="fa fa-plus"></i> Ajouter Caractéristique
                                        </button>
                                    </div> --}}

                                    <div class="form-group">
                                        <div id="imageField">
                                            <div class="col-md-3 input-group-addon">Image</div>
                                                @foreach($product->image as $image)
                                                    @if($image=="noImage.jpg")
                                                        <img src="{{ '/storage/'.$image }}" width="200px">
                                                    @else
                                                        <img src="{{ '/storage/category_images/'.$image }}">
                                                    @endif
                                                @endforeach
                                                
                                            <div class="input-group">
                                                <input type="file" id="image" name="image[]" multiple="" class="form-control @error('image') is-invalid @enderror">
                                            </div>
                                            @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="cloneField('imageField','input-group')">
                                                <i class="fa fa-plus"></i> Ajouter une autre image
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 input-group-addon">Stock</div>
                                        <div class="input-group">
                                            <input type="number" id="stock" name="stock" value="{{ old('stock',$product->stock->stock) }}" class="form-control @error('stock') is-invalid @enderror">
                                        </div>
                                        @error('stock')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
      
      function AddAttributField(){
          // get selected option text not the value
        var attributName = document.getElementById('attribute').options[ document.getElementById('attribute').selectedIndex].text;
        var attributId = document.getElementById('attribute').value;
        var results = document.querySelector('#attributField') //append results
        // results.innerHTML = '' //clear the results on each update
        
            var input = document.createElement('input') //create input
            input.type = "text";
            input.name = "attribute_value[]";
            input.placeholder = "Value";
            input.className = "form-control";

            var inputId = document.createElement('input') //create input
            inputId.type = "hidden";
            inputId.name = "attribute_id[]";
            inputId.value = attributId;

            let div= document.createElement("div");
            div.className="mt-2";

            let p= document.createElement("p");
            p.className="text-danger";
            p.innerHTML="supprimer";
            p.onclick=function () {
                    this.parentElement.parentElement.remove();
                };

            let divRow= document.createElement("div");
            divRow.className="row form-group";

            let divColLabel= document.createElement("div");
            divColLabel.className="col-12 col-md-3";

            let divColInput= document.createElement("div");
            divColInput.className="col-12 col-md-3";

            let divColButton= document.createElement("div");
            divColButton.className="col-12 col-md-3";

            let label = document.createElement("label"); //create label
            label.className="form-control-label";
            label.innerText = attributName;

                results.appendChild(div);
                    div.appendChild(divRow);
                        divRow.appendChild(divColLabel);
                            divColLabel.appendChild(label);
                        divRow.appendChild(divColInput);
                            divColInput.appendChild(input);
                             divColInput.appendChild(inputId);
                        divRow.appendChild(divColButton);
                            divColButton.appendChild(p);
      }
    //   function RemoveAttributField(e){
    //     e.parentNode.removeChild(e);
    //   }
    </script>
    
@endsection
