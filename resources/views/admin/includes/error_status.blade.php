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