
@extends('layouts.frontenduser_assdss')
@section('content')

@if(session('success'))
    <div id="overlay" >
    <div class="alert alert-info alert-dismissible col-md-3" id="success-message">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      {{ session('success') }}
    </div>
  </div>

@endif

@if(session('warning'))
  <div id="overlay" >
    <div class="alert alert-info alert-dismissible col-md-3" id="warning-message">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-circle"></i> Alert!</h5>
      {{ session('warning') }}
    </div>
  </div>
  @endif

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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
              <h3 style="text-align: center;">View Applications</h3>
              </div>
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    
                <div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter">
                  
              </div>
            </div>
          </div>
          <div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                    <tr>
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Application Date: activate to sort column ascending" style="">Application Date</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Application No: activate to sort column ascending">Application No</th>
                      <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Patient's Name: activate to sort column ascending">Patient's Name</th>
                      <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="NIC: activate to sort column ascending" style="">NIC</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Disease: activate to sort column ascending" style="">Disease</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Phone No: activate to sort column ascending" style="">Phone No.</th>
                      <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="P=File#1: activate to sort column ascending" style="">File#1</th>
                      <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="File#2: activate to sort column ascending" style="">File#2</th>
                      <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="File#3: activate to sort column ascending" style="">File#3</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Added User: activate to sort column ascending" style="">Added User</th>
                      <th aria-controls="example1" rowspan="1" colspan="1" ></th>
                    </tr>
                  </thead>
                  <tbody>  
                  @php
                   
                    usort($joinedData, function($a, $b) {
                      return strtotime($b->created_at) - strtotime($a->created_at);
                    });
                    $counter = 1;
                  @endphp  
                  @foreach ($joinedData as $data)             
                  <tr class="odd">
                  <td class="dtr-control sorting_1" tabindex="0">{{ $counter++ }}</td>
                  <td style="">{{ Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}</td>
                  <td>{{ $data->application_no }}</td>
                  <td>{{ $data->patient_name }}</td>
                  <td style="">{{ $data->patient_nic }}</td>
                  <td style="">{{ $data->disease_type }}</td>
                  <td style="">{{ $data->patient_phone }}</td>
                  <td style="">
                  @if (!empty($data->pdf_path))
                   
                  <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path,8,24)]) }}" target="_blank"><i class="fas fa-file-pdf"></i></a>
                  @else
                  <p>X</p>
                  @endif
                  </td>
                  <td style="">
                  @if ($data->pdf_path2 != 0)
                  <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path2,8,24)]) }}" target="_blank"><i class="fas fa-file-pdf"></i></a>
                  @else
                  <p>X</p>
                  @endif
                  </td>
                  <td style=""> 
                  @if ($data->pdf_path3 != 0)
                  <a href="{{ route('pdf.view', ['id' => $data->id ,'pdf_path' => substr($data->pdf_path3,8,24)]) }}" target="_blank"><i class="fas fa-file-pdf"></i></a>
                  @else
                  <p>X</p>
                  @endif
                  </td>
                  <td style="">{{ $data->name }}</td>
                  <!-- <td style=""><button type="submit" class="btn btn-primary btn-block">View</button></td> -->
                  <td><a href="{{route('application.each', $data->application_id)}}"><button class="btn btn-success btn-block">View</button></a></td>
    </tr>
                  @endforeach
                  </tbody>
                  
                </table>
                </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                      <ul class="pagination">
                        <li class="paginate_button page-item previous disabled" id="example1_previous">
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
        }, 5000); // 3000 milliseconds = 3 seconds
    });
</script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>

@endsection