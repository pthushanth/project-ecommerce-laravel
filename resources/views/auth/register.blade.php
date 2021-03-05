@extends('front.app')
@section('styles')
@endsection
@section('content')
<div class="container justify-content-center">
    <section id="sectionLogin">
        <h3 class="my-4 text-center">Création de compte</h3>
        <div class="formBox">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="mme" name="title" value="mme"  {{ old('title') == "mme" ? 'checked' : ''}}>
                        <label class="form-check-label" for="mme">Madame</label></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="m" name="title" value="m" {{ old('title') == "m" ? 'checked' : ''}}>
                        <label class="form-check-label" for="m">Monsieur</label>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
                    </div>
                    <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror"
                        name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                    @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Prénom</span>
                    </div>
                    <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror"
                        name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                    @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">E-mail</span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Mot de passe</span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Confirmez Mot de passe</span>
                    </div>
                    <input id="password-confirm" type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" required>
                </div>

                <button class="btn btnSubmit" type="submit">Créer mon compte</button>
            </form>
        </div>

        <p class="text-muted dashed"><span>J'ai un compte</span> </p>
        <a href="{{ route('login') }}"><button class="btn btnSubmit" type="submit">Se connecter</button></a>
    </section>



    @endsection