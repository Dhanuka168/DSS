
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document Tracking System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('fonts2.css')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <script src="{{asset('dist/js/jquery.min.js')}}"></script>
  <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}" type="text/javascript"></script>    
  
  <script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}" type="text/javascript"></script>
  <style>

      /* Pop up box */
        #popupContainer {
          position: fixed;
          top: 55%;
          left: 60%;
          transform: translate(-50%, -50%);
          width: 50%;       
          background: #fff;
          padding: 20px;
          border: 1px solid #ccc;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          z-index: 1001;
        }

        /* pop up box overlay1 */

        #popupoverlay {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.5);
          z-index: 1000;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1;
        }

        #info-message {
            position: fixed;
            top: 20%;
            left: 30%;
            transform: translate(-50%, -50%);
            background-color: #40b2db;
            color: white;
            padding: 15px;
            display: none;
            z-index: 2;
        }

        #warning-message {
            position: fixed;
            top: 20%;
            left: 30%;
            transform: translate(-50%, -50%);
            background-color: #e3c114;
            color: white;
            padding: 15px;
            display: none;
            z-index: 2;
        }

        #success-message {
            position: fixed;
            top: 20%;
            left: 30%;
            transform: translate(-50%, -50%);
            background-color: #11c23b;
            color: white;
            padding: 15px;
            display: none;
            z-index: 2;
        }
        #error-message {
            position: fixed;
            top: 20%;
            left: 30%;
            transform: translate(-50%, -50%);
            background-color: #f44336;
            color: white;
            padding: 15px;
            display: none;
            z-index: 2;
        }

        .main-footer {
        display: flex;
        justify-content: right;
        align-items: center;
        height: 50px; /* Set an appropriate height */
    }
  

   /*  .formerror {
      color: #ff0000;
      font-size: 15px;
      display: inline-block !important;
      margin-top: 5px !important;
      margin-bottom: 5px !important;
  } */

  form .error {
  color: #ff0000;
}
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" id="logoutButton">
          <i class="fa fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('Emblem_of_Sri_Lanka.png')}}" alt="GovLOgo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">President's Fund</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="row justify-content-center">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex center">
        <div class="info">
        @if(auth()->check())
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        @endif
        </div>
      </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item"><a href="javascript:void(0)">
            <a href="{{'/redirects'}}" class="nav-link active isActive">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>           
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-passport"></i>
              <p>
                Document Tracking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="javascript:void(0)">
                <a href="{{route('application.add')}}" class="nav-link isActive">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                  Add Application
                  </p>
                </a>    
              </li>
          <!-- <li class="nav-item">
                  <a href="{{route('application.create')}}" class="nav-link isActive">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      View Application Temp
                    </p>
                  </a>         
                </li> --> 
                <li class="nav-item">
                  <a href="{{route('application.view')}}" class="nav-link isActive">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      View Application
                    </p>
                  </a>         
                </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-journal-whills"></i>
              <p>
                Application Tracking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a href="javascript:void(0)">
                  <a href="{{route('letter.add')}}" class="nav-link isActive">
                    <i class="nav-icon fas fa-search"></i>
                    <p>
                    Search Application
                    </p>
                  </a>    
                </li>
                <li class="nav-item">
                  <a href="{{route('letter.create')}}" class="nav-link isActive">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                      Create Application
                    </p>
                  </a>         
                </li> 
                <li class="nav-item">
                  <a href="{{route('letter.view')}}" class="nav-link isActive">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      View Applications
                    </p>
                  </a>         
                </li> 
            </ul>
          </li>     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row justify-content-center ">
          <img src="{{ asset('president-fund-logo.png') }}" alt="" srcset="" width="250" height="100">
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    @yield('content')
    


  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="row">
    <strong>&copy;<a href="#">Dhanuka Botheju</a>.</strong>
    All rights reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script> -->
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script>
  //logout
    $(document).ready(function(){
      $('#logoutButton').on('click', function(e){
        e.preventDefault();
        $.ajax({
          url:'{{route("logout")}}',
          method: 'POST',
          data:{
            _token:'{{csrf_token()}}'
          },
          success: function(response){
            window.location.href='/';
          },
          error:function(xhr,status,error){
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>

<!-- <script>
  $(document).ready(function () {
    $(".isActive").on("click", function (event) {
      event.preventDefault(); // Prevent the default action of the link

      // Remove the 'active' class from all navigation links
      $(".isActive").removeClass("active");

      // Add the 'active' class to the clicked navigation link
      $(this).addClass("active");

      // Get the href attribute of the clicked link
      var href = $(this).attr("href");

      // Use AJAX to fetch the content
      $.ajax({
        url: href,
        method: "GET",
        success: function (data) {
          // Update a specific container on the page with the fetched content
          $("#content-container").html(data);
        },
        error: function () {
          console.error("Failed to load content.");
        }
      });
    });
  });
</script> -->
<script>
  $("#btnclearnic").click(function() {
     $('#txtnic').val("");
   });

  $("#btnclearapplication").click(function() {
    $('#patientname').val("");
    $('#patientphone').val("");
    $('#patientaddress1').val("");
    $('#patientaddress2').val("");
    $('#patientremarks').val("");
    $('#diseaseSelect').val("");
    $('#pdfpath').val("");           
  });

  $("#btnclear").click(function() {
    $('#txtpname').val("");
    $('#txtpnic').val("");
    $('#txtappname').val("");
    $('#txtappnic').val("");
    $('#txtcity').val("");
    $('#txtphone').val("");
    $('#diseaseSelect').val("");           
  });
</script>
<script src="{{asset('plugins/jquery-validation/formvalidation.js')}}" type="text/javascript"></script>
</body>
</html>
