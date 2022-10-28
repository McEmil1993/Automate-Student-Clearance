<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" >

  <title>Tmc Student Clearance</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"><link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- table -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('uploads/tmc-logo.png') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/multiple/css/bootstrap-select.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-select/css/bootstrap-select.css')}}">
   


    <script type="text/javascript" src="{{ asset('plugins/multiple/js/bootstrap-select.js') }}"></script>


   
    <!-- loader -->
    <!-- <link rel="stylesheet" href="{{ asset('preloader/css/normalize.css')  }}"> -->
	
	<script src="{{ asset('preloader/js/vendor/modernizr-2.6.2.min.js')  }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('preloader/css/main.css')  }}">

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery.printThis.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- table datatables -->
    <script src="{{ asset('dist/js/5b94210430.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/loader.js') }}"></script>
    <!-- <script src="{{ asset('preloader/js/main.js') }}"></script> -->
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap-select/js/bootstrap-select.js') }}"></script>

    <style type="text/css">
      .active3{
      background-color: #296694!important;
      color: #fff!important;
    }
    .das {
  overflow-y: scroll;
  height: 60vh;
}
    /*.active1{
      background-color: #296694!important;
      color: #fff!important;
    }

    .card-header{
      background-color: #296694;
    }
    .btn{
      font-style: italic;
      
    }

    li #dashboard:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #dashboard{
      color: #fff;
    }

    li #clearance:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #clearance{
      color: #fff;
    }
    #clearance:active{
      color: #fff;
    }

    li #assignee:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #assignee{
      color: #fff;
    }

    li #students:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #students{
      color: #fff;
    }

    li #manage_others:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #manage_others{
      color: #fff;
    }

    li #position:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #position{
      color: #fff;
    }
  
    li #department:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #department{
      color: #fff;
    }

    li #course:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #course{
      color: #fff;
    }

    li #year_lvl:hover{
      background-color: #ed9d3b;
      color: #000;
    }
    #year_lvl{
      color: #fff;
    }

    li #school_year:hover{
      background-color: #ed9d3b;
      color: #fff;
    }
    #school_year{
      color: #fff;
    }

    li #pfix_sfix:hover{
      background-color: #ed9d3b;
      color: #fff;
    }
    #pfix_sfix{
      color: #fff;
    }

    li #access_right:hover{
      background-color: #ed9d3b;
      color: #fff;
    }
    #access_right{
      color: #fff;
    }*/
    .loader1 {
      display: -ms-flexbox;
      display: flex;
      background-color: #6f7275;
      height: 100vh;
      width: 100%;
      transition: height 200ms linear;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 9999;
    }

    @media (min-width: 992px) {
  .modal-lg1,
  .modal-xl1 {
    max-width: 800px;
  }
}

@media (min-width: 1200px) {
  .modal-xl1 {
    max-width: 900px;
  }
}

  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed "  data-panel-auto-height-mode="height">

<!--   <div class="loader1 flex-column justify-content-center align-items-center" >
    <img class="animation__shake" src="{{ asset('svg-loaders/spinning-circles.svg') }}" alt="AdminLTELogo" height="60" width="60">
  </div> -->


<div  class="wrapper" >

    @include('layouts.topvar')

    @include('layouts.sidevar')
    
    <div style="overflow: auto;" >
       @yield('content')
    </div>
   
    
    @include('layouts.footer')
  
    
<!-- footer -->
</div>
<script type="text/javascript">

  $('#m-load').modal('show');
  $(function() {

     $('#m-load').delay(1000).fadeOut(500);

      setTimeout(function(){
        $('#m-load').modal("hide");
        $('.modal-backdrop').attr('style','display:none;');
        
      }, 1000);
  });
  $('body').attr('style','');
</script>
</body>

<!-- Script -->
  
</html>