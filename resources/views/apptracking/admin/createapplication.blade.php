
@extends('layouts.frontendadmin')
@section('content')

@if(session('error'))
    <div id="overlay" >
    <div class="alert alert-info alert-dismissible col-md-3" id="error-message">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-times"></i> Alert!</h5>
      {{ session('error') }}
    </div>
  </div>

@endif

@if(session('info'))
  <div id="overlay" >
    <div class="alert alert-info alert-dismissible col-md-3" id="info-message">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-info"></i> Alert!</h5>
      {{ session('info') }}
    </div>
  </div>
  @endif

  <section class="content">
      <div class="container-fluid mt-4 md-4">
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-10">
            <div class="card card-success">
              <div class="card-header">
                <div style="text-align:center; font-size:18px; font-weight:bold;" >Create Application</div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="{{route('letter.store')}}" id="frmAddNewApp">
                @csrf
                <div class="row">&nbsp;</div>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">Appliacnt's Name</label>
                    <div class="col-md-4"><input type="text" class="form-control" id="txtappname" name="txtappname" /></div>
                    <div class="col-md-1">&nbsp;</div>
                      <label class="col-md-1 col-form-label">NIC</label>
                    <div class="col-md-3"><input type="text" class="form-control" maxlength="12" id="txtappnic" name="txtappnic" /></div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">Patient's Name</label>
                    <div class="col-md-4"><input type="text" class="form-control" id="txtpname" name="txtpname" /></div>
                    <div class="col-md-1">&nbsp;</div>
                      <label class="col-md-1 col-form-label">NIC</label>
                    <div class="col-md-3"><input type="text" class="form-control" maxlength="12" id="txtpnic" name="txtpnic" /></div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2 col-form-label">City</label>
                    <div class="col-md-2"><input type="text" class="form-control" id="txtcity" name="txtcity" /></div>
                    <!-- <div class="col-md-1">&nbsp;</div> -->
                      <label class="col-md-1 col-form-label">Phone</label>
                    <div class="col-md-2"><input type="text" class="form-control" maxlength="10" id="txtphone" name="txtphone" /></div>
                    <label for="inputEmail3" class="col-md-2 col-form-label">Disease Type</label>
                    <div class="col-md-2">
                      <select id="diseaseSelect" name="diseaseid" class="form-control">
                        <option value="" disabled selected>Select Disease</option>
                        @foreach ($allData as $data)
                          <option value="{{ $data['id'] }}">{{ $data['disease_type'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                  <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block">Submit</button></div>
                    <div class="col-md-3"><button type="button" class="btn btn-danger btn-block" id="btnclear">Clear</button></div>
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
        $('#info-message').show();
        $('#warning-message').show();
        $('#error-message').show();

        // Set a timeout to hide the overlay and warning message after a certain duration (e.g., 3 seconds)
        setTimeout(function() {
            $('#overlay').hide();
            $('#success-message').hide();
            $('#info-message').hide();
            $('#warning-message').hide();
            $('#error-message').hide();
        }, 3000); // 3000 milliseconds = 3 seconds
    });
</script>
@endsection