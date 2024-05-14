
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
      <div class="container-fluid">
        <div class="row">
          &nbsp;
</div>  
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-6">

            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Enter Application Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" id="frmAddApp" action="{{route('application.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Patient's NIC No.</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="patientnic" value="{{ $nic }}" name="patientnic" readonly>
                    </div>
                  </div>     
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Patient's Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="patientname" name="patientname" placeholder="Enter Patient's Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Address Line 1</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="patientaddress1" name="patientaddress1" placeholder="Home No. and Street">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Address Line 2</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="patientaddress2" name="patientaddress2" placeholder="City">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Phone No.</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="patientphone" name="patientphone" placeholder="Patient's Phone Number" maxlength="10">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Disease Type</label>
                    <div class="col-sm-6">
                      <select id="diseaseSelect" name="diseaseid" class="form-control">
                        <option value="" disabled selected>Select Disease</option>
                        @foreach ($allData as $data)
                          <option value="{{ $data['id'] }}">{{ $data['disease_type'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Attach a File</label>
                    <div class="col-sm-6">
                      <input type="file" class="form-control" id="pdfpath" name="pdfpath" onchange="displayFileName()">
                    </div>
                    <!-- <p id="file-name-display" style="color: red;">No files chosen</p> -->
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Remarks</label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 300px; height: 100px;"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer form-group">
                  <div class="row"> 
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block">Submit</button></div>
                    <div class="col-md-3"><button type="button" class="btn btn-primary btn-block" id="btnclearapplication">Clear</button></div>
                    <div class="col-md-3"><a href="{{route('application.add')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-1">&nbsp;</div>  
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
<!--     <script>
        function displayFileName() {
            // Get the input element
            var fileInput = document.getElementById('pdfpath');

            // Get the display element
            var fileNamesDisplay = document.getElementById('file-name-display');

            // Clear existing content
            fileNamesDisplay.innerHTML = '';

            // Display the chosen file names with their extensions
            if (fileInput.files.length > 0) {
                Array.from(fileInput.files).forEach(function(pdfpath) {
                    var fileNameParagraph = document.createElement('p');
                    fileNameParagraph.textContent = pdfpath.name;
                    fileNamesDisplay.appendChild(fileNameParagraph);
                });
            } else {
                var noFilesParagraph = document.createElement('p');
                noFilesParagraph.textContent = 'No files chosen';
                fileNamesDisplay.appendChild(noFilesParagraph);
            }
        }
    </script> -->
    <script>
    $(document).ready(function() {
        // Show overlay and warning message
        $('#overlay').show();
        $('#info-message').show();
        $('#error-message').show();

        // Set a timeout to hide the overlay and warning message after a certain duration (e.g., 3 seconds)
        setTimeout(function() {
            $('#overlay').hide();
            $('#info-message').hide();
            $('#error-message').hide();
        }, 1000); // 1000 milliseconds = 3 seconds
    });
</script>

@endsection