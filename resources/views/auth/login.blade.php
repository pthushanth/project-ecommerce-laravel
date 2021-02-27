@extends('front.app')
@section('styles')
@endsection
@section('content')
<div class="container justify-content-center">
    <section id="sectionLogin">
        <h3 class="my-4 text-center">Connexion</h3>
        <div class="formBox">
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                        name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="btn btnSubmit" type="submit">Se connecter</button>
            </form>
        </div>

        <p class="text-muted dashed"><span>J" n'ai pas du compte</span> </p>
        <a href="{{ route('register') }}"><button class="btn btnSubmit" type="submit">Créer mon compte</button></a>
    </section>



    @endsection