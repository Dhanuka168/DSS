
@extends('layouts.frontendsuperadmin')
@section('content')

@if(session('error'))
  <div id="overlay" >
    <div class="alert alert-info alert-dismissible col-md-3" id="error-message">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-circle"></i> Alert!</h5>
      {{ session('error') }}
    </div>
  </div>
  @endif

<section class="content">
      <div class="container-fluid mt-4 md-4">
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Enter NIC</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="get" action="{{route('letter.search')}}" id="frmchecknic">
                @csrf
                <div class="row">&nbsp;</div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">NIC No.</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="txtnic" name="txtnic" maxlength="12" placeholder="NIC format- 00012356789, 123456789123" />
                      <!-- <span class="formerror"></span> -->
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="row">
                  <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block">Search</button></div>
                    <div class="col-md-3"><button type="button" class="btn btn-danger btn-block" id="btnclearnic">Clear</button></div>
                    <div class="col-md-3">&nbsp;</div>
                </div>
              </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <script>
    $(document).ready(function() {
        // Show overlay and warning message
        $('#overlay').show();
        $('#success-message').show();
        $('#warning-message').show();
        $('#error-message').show();

        // Set a timeout to hide the overlay and warning message after a certain duration (e.g., 3 seconds)
        setTimeout(function() {
            $('#overlay').hide();
            $('#success-message').hide();
            $('#warning-message').hide();
            $('#error-message').hide();
        }, 3000); // 3000 milliseconds = 3 seconds
    });
</script>
@endsection