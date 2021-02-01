<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet"> 
    {{-- App css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


    <!-- Main CSS-->
    @yield('styles')

</head>

<body class="animsition">
    <div class="page-wrapper">

        <!-- PAGE CONTAINER-->
        <div class="">
    
            {{-- HEADER DESKTOP --}}
            @include('front.layouts.header')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- END MAIN CONTENT-->

            @include('front.layouts.footer')

            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    {{-- app js --}}
    <script src="{{asset('js/app.js')}}"></script>



<script src="{{ mix('js/app.js') }}"></script>

    @yield('scripts')
</body>

</html>
<!-- end document-->
