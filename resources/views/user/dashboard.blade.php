
@extends('layouts.frontenduser')
@section('content')

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">&nbsp;</div>
        <!-- Info boxes -->
        <div class="row">
<!--           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
       
            </div>
         
          </div> -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-6" style="text-align:center;">
          <a href="{{route('application.add')}}"style="color: black;">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-signature"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight:bold;">Document Tracking System</span>
                <span class="info-box-number">DTS</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-6" style="text-align:center;">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight:bold;">Letter Tracking System</span>
                <span class="info-box-number">LTS</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
<!--           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
           
            </div>
        
          </div> -->
          <!-- /.col -->
        </div>       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->


@endsection