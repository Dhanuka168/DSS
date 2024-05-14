
@extends('layouts.frontendsuperadmin')
@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
          &nbsp;
</div>  
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-10">

            <!-- Horizontal Form -->
            <div class="card card-danger">
              <div class="card-header">
                <div style="text-align:center; font-size:18px; font-weight:bold;">Inactivated Application</div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @foreach ($joinedData as $data)
              <form class="form-horizontal" method="post" id="frmEachApp" action="{{route('application.notinactive')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Asked User</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="{{ $data->name }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Application No.</label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" value="{{ $data->application_no }}" disabled>
                      <input type="hidden" value="{{ $data->application_id }}" name="frmappid">
                      <input type="hidden" value="{{ $data->delete_req_id }}" name="frmdrid">
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <label for="inputEmail3" class="col-md-2 col-form-label">Patient's NIC No.</label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" value="{{ $data->patient_nic }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Patient's Name</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="{{ $data->patient_name }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Address Line 1</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="{{ $data->patient_address1 }}" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Address Line 2</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" value="{{ $data->patient_address2 }}" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Phone No.</label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" value="{{ $data->patient_phone }}" disabled>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                    <label for="inputEmail3" class="col-md-2 col-form-label">Disease Type</label>
                    <div class="col-md-3">
                    <input type="text" class="form-control" value="{{ $data->disease_type }}" disabled>
                    </div>
                  </div>

                  
                  @if  ($data->pdf_path2 == 0) 
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Attached File</label>
                    <div class="col-md-2">
                    <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path,8,24)]) }}" target="_blank"><img src="{{asset('/dist/img/pdf-icon.png')}}" width="50" height="50"></a>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-2 col-form-label">&nbsp;</div>
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
                    <label for="inputEmail3" class="col-md-2 col-form-label">User Message</label>
                    <div class="col-md-4">
                      <textarea class="form-control" id="usermessage" name="usermessage" style="width: 250px; height: 100px;" disabled>{{$data->user_message}}</textarea>
                    </div>
                    <label for="inputEmail3" class="col-md-2 col-form-label">Remarks</label>
                    <div class="col-md-3">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 250px; height: 100px;" disabled>{{$data->patient_remarks}}</textarea>
                    </div>
                  </div>
                </div>
                  <div class="card-footer">
                 <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-2"><a href="{{'/redirects'}}"><button type="button" class="btn btn-success btn-block">Dashboard</button></a></div>
                    <div class="col-md-2"><a href="{{route('application.inactivelist')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-3">&nbsp;</div>
                  </div>
                
                  @elseif ($data->pdf_path2 != 0 & $data->pdf_path3 == 0)
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Attached File</label>
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
                    <div class="col-md-2 col-form-label">&nbsp;</div>
                    <div class="col-md-2">File_1</div>
                    <div class="col-md-2">File_2</div>
                    <div class="col-md-2">&nbsp;</div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">User Message</label>
                    <div class="col-md-4">
                      <textarea class="form-control" id="usermessage" name="usermessage" style="width: 250px; height: 100px;" disabled>{{$data->user_message}}</textarea>
                    </div>
                    <label for="inputEmail3" class="col-md-2 col-form-label">Remarks</label>
                    <div class="col-md-3">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 250px; height: 100px;" disabled>{{$data->patient_remarks}}</textarea>
                    </div>
                  </div>
                </div>
                  <div class="card-footer">
                  <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-2"><a href="{{'/redirects'}}"><button type="button" class="btn btn-success btn-block">Dashboard</button></a></div>
                    <div class="col-md-2"><a href="{{route('application.inactivelist')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-3">&nbsp;</div>
                  </div>
                  </div>
                  @else
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-2 col-form-label">Attached File</label>
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
                    <div class="col-md-2 col-form-label">&nbsp;</div>
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
                    <label for="inputEmail3" class="col-md-2 col-form-label">User Message</label>
                    <div class="col-md-4">
                      <textarea class="form-control" id="usermessage" name="usermessage" style="width: 300px; height: 100px;" disabled>{{$data->user_message}}</textarea>
                    </div>
                    <label for="inputEmail3" class="col-md-2 col-form-label">Remarks</label>
                    <div class="col-md-3">
                      <textarea class="form-control" id="patientremarks" name="patientremarks" style="width: 300px; height: 100px;" disabled>{{$data->patient_remarks}}</textarea>
                    </div>
                  </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-2"><a href="{{'/redirects'}}"><button type="button" class="btn btn-success btn-block">Dashboard</button></a></div>
                    <div class="col-md-2"><a href="{{route('application.inactivelist')}}"><button type="button" class="btn btn-danger btn-block">Cancel</button></a></div>
                    <div class="col-md-3">&nbsp;</div>
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
    

    <!-- Dynamic Form starts -->

    <div id="popupoverlay"></div>
    <div id="popupContainer" style="display:none;">
            <div class="card card-danger">
              <div class="card-header">
                <div style="text-align:center; font-size:18px; font-weight:bold;">Inactive Application</div>
              </div>
              <form id="dynamicForm" method="post" action="{{route('application.appinactive')}}">
              @csrf
                <div class="card-body">
                  <input type="hidden" value="{{$data->application_id}}" name="frmappid">
                 <div class="form-group"><p style="font-size:18px; font-weight:bold;">Are you sure you want to inactive the application</p><div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <div class="row">
                      <div class="col-md-3">&nbsp;</div>
                      <div class="col-md-3"><button type="submit" class="btn btn-danger btn-block">Yes</button></div>
                      <div class="col-md-3"><button type="button" id="dismissButton" class="btn btn-primary btn-block">No</button></div>
                      <div class="col-md-3">&nbsp;</div>
                  </div>
                </div>
              </form>
            </div>
      </div>
      
      <!-- Dynamic Form Ends -->
    <!-- <span id="formappend">Click to open the pop-up</span> -->
      <!-- <span id="formappend"> </span> -->
    </section>

<script>
    var popupoverlay = document.getElementById('popupoverlay');
    var popupContainer = document.getElementById('popupContainer');
    var formAppend = document.getElementById('btninactive');
    var dismissButton = document.getElementById('dismissButton');

    formAppend.addEventListener('click', function() {
        // Show the overlay and pop-up
        popupContainer.style.display = 'block';
        popupoverlay.style.display = 'block';
        
    });

    dismissButton.addEventListener('click', function() {
        // Hide the overlay and pop-up
        popupoverlay.style.display = 'none';
        popupContainer.style.display = 'none';
    });
</script>

@endsection