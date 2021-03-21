@extends('client.layouts.app')

@section('title','Mes infp perso')

@section('styles')
<style>
    .file {
        visibility: hidden;
        position: absolute;
    }

    #preview {
        /* max-width: 200px; */
        width: 100%;
    }

    .divImage {
        max-width: 160px;
    }

    .browse {
        width: 100%;
    }
</style>

@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">Mes information personnels</div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @elseif (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success')}}
                </div>
                @endif

                <form enctype="multipart/form-data" action="{{route('client.account.update')}}" method="POST">
                    @csrf
                    <div class="form-row justify-content-center">
                        <div class="divImage mx-auto">
                            <div class="form-group">
                                <img src="{{asset($client->getAvatarUrl())}}" id="preview" class="img-thumbnail">
                                <input type="file" name="avatar" class="file" accept="image/*">
                                <input type="text" class="form-control" disabled placeholder="photo de profile"
                                    id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Browse...</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="mme" name="title" value="mme"
                                {{ ($client->customer->title=="mme")? "checked" : "" }}>
                            <label class="form-check-label" for="mme">Madame</label></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="m" name="title" value="m"
                                {{ ($client->customer->title=="m")? "checked" : "" }}>
                            <label class="form-check-label" for="m">Monsieur</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastname">Nom</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom"
                                value="{{$client->customer->lastname}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname">Prénom</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom"
                                value="{{$client->customer->firstname}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{$client->email}}">
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Adresse</label>
                        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Adresse"
                            value="{{$client->customer->address}}">
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputZip">Code Postal</label>
                            <input type="text" class="form-control" id="inputZip" name="post_code"
                                value="{{$client->customer->post_code}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Ville</label>
                            <input type="text" class="form-control" id="inputCity" name="city"
                                value="{{$client->customer->city}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});
</script>
@endsection