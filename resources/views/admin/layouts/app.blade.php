<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet"
        media="all">


    <!-- Vendor CSS-->
    <link href="{{asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet"
        media="all">
    <link href="{{asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    {{-- dataTable --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

    {{-- App css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet">
    @yield('styles')

</head>

<body class="animsition">
    <div class="page-wrapper">
        {{-- HEADER MOBILE--}}
        @if(Auth::user()) @include('admin.layouts.header_mobile') @endif

        {{-- MENU SIDEBAR --}}
        @if(Auth::user()) @include('admin.layouts.sidebar') @endif

        <!-- PAGE CONTAINER-->
        <div class="page-container">

            {{-- HEADER DESKTOP --}}
            @if(Auth::user()) @include('admin.layouts.header_desktop') @endif

            <!-- MAIN CONTENT-->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    {{-- app js --}}
    <script src="{{asset('js/app.js')}}"></script>

    <!-- Vendor JS -->
    <script src="{{asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('admin/js/main.js')}}"></script>
    {{-- tiny text editeur --}}
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({ selector:'textarea' });</script> --}}

    {{-- CKEditeur text editeur --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        //get all textera 
        var allEditors = document.querySelectorAll('textarea');
        //replace by editor for eacher textearea
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor
            .create(allEditors[i])
            .catch( error => {
                console.error( error );
            } );
        }
        
    </script>

    {{-- Delete alert warning --}}
    <script src="{{asset('admin/js/bootbox.min.js')}}"></script>
    <script>
        $(document).on("click","#delete",function(e){
      e.preventDefault();
      var link=$(this).attr("href");
      bootbox.confirm("Voulez-vous vraiment supprimer cet élement ?", function(confirmed){
        if(confirmed){
          window.location.href=link;
        }
      })
    })
    </script>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>


    @yield('scripts')
</body>

</html>
<!-- end document-->
