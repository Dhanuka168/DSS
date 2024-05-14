
@extends('layouts.frontendadmin')
@section('content')

<!-- @if(session('error'))
    <div id="error-message" class="alert alert-danger">
        {{ session('error') }}
    </div>

    <script>
        // Fade out the success message after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('#error-message').fadeOut();
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    </script>
    @else()
    <div></div>
@endif
@if(session('warning'))
    <div id="warning-message" class="alert alert-warning">
        {{ session('warning') }}
    </div>

    <script>
        // Fade out the success message after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('#warning-message').fadeOut();
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    </script>
@endif -->
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
                <h3 class="card-title">Application Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @foreach ($joinedData as $data)
              <form class="form-horizontal" method="post" id="frmEachApp" action="{{route('application.pdf2', $data->application_id)}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Application No.</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="{{ $data->application_no }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Patient's NIC No.</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="{{ $data->patient_nic }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Patient's Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="{{ $data->patient_name }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Address Line 1</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="{{ $data->patient_address1 }}" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Address Line 2</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="{{ $data->patient_address2 }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Phone No.</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="{{ $data->patient_phone }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Disease Type</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" value="{{ $data->disease_type }}" disabled>
                    </div>
                  </div>

                  
                  @if  ($data->pdf_path2 == 0) 
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Attached File</label>
                    <div class="col-sm-6">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-4 col-form-label">&nbsp;</div>
                    <div class="col-md-2">
                    File_1
                    </div>
                    <div class="col-md-2">
                    &nbsp;
                    </div>
                    <div class="col-md-2">
                    &nbsp;
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Attach a File</label>
                    <div class="col-sm-6">
                      <input type="file" class="form-control" id="pdfpath2" name="pdfpath2" onchange="displayFileName()">
                    </div>
                    <!-- <p id="file-name-display" style="color: red;">No files chosen</p> -->
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Remarks</label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 300px; height: 100px;" disabled>{{$data->patient_remarks}}</textarea>
                    </div>
                  </div>
                </div>
                  <div class="card-footer">
                 <div class="row">
                    <div class="col-md-2">&nbsp;</div>
                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block">Submit</button></div>
                    <div class="col-md-3"><a href="{{route('application.view')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-2">&nbsp;</div>
                  </div>
                
                  @elseif ($data->pdf_path2 != 0 & $data->pdf_path3 == 0)
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Attached File</label>
                    <div class="col-md-2">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                    <div class="col-md-2">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path2,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                    <div class="col-md-2">
                    &nbsp;
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-4 col-form-label">&nbsp;</div>
                    <div class="col-md-2">File_1</div>
                    <div class="col-md-2">File_2</div>
                    <div class="col-md-2">&nbsp;</div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Attach a File</label>
                    <div class="col-sm-6">
                      <input type="file" class="form-control" id="pdfpath3" name="pdfpath3" onchange="displayFileName()">
                    </div>
                    <!-- <p id="file-name-display" style="color: red;">No files chosen</p> -->
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Remarks</label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 300px; height: 100px;" disabled>{{$data->patient_remarks}}</textarea>
                    </div>
                  </div>
                </div>
                  <div class="card-footer">
                  <div class="row">
                  <div class="col-md-2">&nbsp;</div>
                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block">Submit</button></div>
                    <div class="col-md-3"><a href="{{route('application.view')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-2">&nbsp;</div>
                  </div>
                  </div>
                  @else
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Attached File</label>
                    <div class="col-md-2">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                    <div class="col-md-2">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path2,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                    <div class="col-md-2">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path3,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-4 col-form-label">&nbsp;</div>
                    <div class="col-md-2">
                    File_1
                    </div>
                    <div class="col-md-2">
                    File_2
                    </div>
                    <div class="col-md-2">
                    File_3
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Remarks</label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 300px; height: 100px;" disabled>{{$data->patient_remarks}}</textarea>
                    </div>
                  </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                    <div class="col-md-2">&nbsp;</div>
                    <div class="col-md-3"><button type="submit" class="btn btn-success btn-block">Submit</button></div>
                    <div class="col-md-3"><a href="{{route('application.view')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-2">&nbsp;</div>
                    </div>
                  </div>
                  @endif
                <!-- /.card-body -->
              </div>
                <!-- /.card-footer -->
              </form>
              @endforeach
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    


@endsection