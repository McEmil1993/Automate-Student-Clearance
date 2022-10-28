
@extends('layouts.header')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6 col-8 mb-2">
            <h5 class="m-0 text-dark"><strong> TMC - Clearance/Manage Others/Course</strong></h5>
          </div><!-- /.col -->
          <div class="col-lg-6 col-4">
            <div class="breadcrumb float-right">
              <h6 class="breadcrumb-item">School Year : <span style="color:green;">{{Session::get('school_year')}}</span> | {{Session::get('semester')}} Semester</h6>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="box p-2"><!-- Default box -->
        <div class="card">
        
          <div class="box-body" style="padding:10px">
            
            <button type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New course</button>
            <table id="example2" class="table table-striped projects" >
              <thead>
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <th>
                        <h5><strong>List of course</strong></h5>
                      </th>
                    </div>
                    <div class="col-lg-2">
                      <th>
                        <h5><strong>Status</strong></h5>
                      </th>
                    </div>
                    <div class="col-lg-2">
                      <th width="10%">
                        <h5><strong>Action</strong></h5>
                      </th>
                    </div>
                  </div>
                </tr>
              </thead>
              <tbody>
                @foreach($course as $courses)
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <td>
                        <strong>{{$courses->course}}</strong>  <?php echo '<br>'. $courses->c_d; ?>
                      </td>
                    </div>
                    <div class="col-lg-2">
                      <td>
                        <div class="time-label">
                       
                          
                           <?php echo ($courses->c_s == "1")? ' <strong style="color:#28a745;">Active</strong>' : '<strong  style="color:#dc3545;">Unactive</strong>'; ?>
                        </div>
                      </td>
                    </div>
                    <div class="col-lg-2">
                      <td class="project-actions">
                        <a class="" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit" href="#" data-id="{{$courses->c_id}}" data-course="{{$courses->course}}" data-description="{{$courses->c_d}}" data-status="{{$courses->c_s}}" data-department_id="{{$courses->department_id}}" data-toggle="modal" data-target="#modal-update" >Update Info</a>
                            <a class="dropdown-item delete" data-toggle="modal" data-target="#modal-delete" data-id="{{$courses->c_id}}" data-course="{{$courses->course}}" data-status="{{$courses->c_s}}" href="#"><?php echo ($courses->c_s == "1")? '<strong  style="color:#dc3545;">Deactivate</strong> ' : '<strong style="color:#28a745;">Active</strong>'; ?></a>
                          </div>
                      </td>
                    </div>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div>
    </section><!-- /.content -->
  </div>

  <!-- modal add -->
  <div class="modal fade" id="modal-add" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">New course</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('course_add') }}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Course</label>
            <input type="text" name="course" class="form-control" placeholder="Enter course" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter description" required>
          </div>

          <div class="form-group">
            <label>Department</label>
            <!-- <input type="text" name="description" class="form-control" placeholder="Enter description" required> -->
            <select class="form-control" name="department_id" required>
              <option selected disabled>Select Department</option>

              @foreach($dept as $depts)

              <option value="{{$depts->id}}">{{$depts->department}} - {{$depts->description}}</option>

              @endforeach
              
            </select>
          </div>
         
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
       </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--modal End -->

  <!-- modal update -->
  <div class="modal fade" id="modal-update" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Update course</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('course_update')}}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Course</label>
            <input type="hidden" class="e_id" name="id" id="e_id" >
            <input type="text" name="course" id="e_course" class="form-control e_course" placeholder="Enter course" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" id="e_description" class="form-control" placeholder="Enter description" required>
          </div>
          <div class="form-group">
            <label>Department</label>
            <!-- <input type="text" name="description" class="form-control" placeholder="Enter description" required> -->
            <select class="form-control" name="department_id" id="department_id" required>
              <option selected disabled>Select Department</option>

              @foreach($dept as $depts)

              <option value="{{$depts->id}}">{{$depts->department}} - {{$depts->description}}</option>

              @endforeach
              
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
       </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

   <div class="modal fade" id="modal-delete" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title titl" >Delete course</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('course_delete')}}" method="POST">
          @csrf
        <div class="modal-body">
          <center>
            <input type="hidden" name="id" id="d_id">
             <input type="hidden" name="status" id="d_status">
            <h6 class="t-body"></h6>
          </center>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger btn-ok"><span class="btn-text"></span></button>
        </div>
       </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--modal End -->
  
<script type="text/javascript">
  $('.edit').click(function (){
    
    var id = $(this).attr('data-id');
    var course = $(this).attr('data-course');
    var description = $(this).attr('data-description');
    var department_id = $(this).attr('data-department_id');

    $('.e_id').val(id);
    $('#e_course').val(course);
    $('#e_description').val(description);
    $('#department_id').val(department_id);

  });

  $('.delete').click(function (){
    var id = $(this).attr('data-id');
    var course = $(this).attr('data-course');
    var status = $(this).attr('data-status');

    
    
    if (status == "1") {
      $('.titl').html('Deactivate course');
      $('.t-body').html('Are you sure want to deactivate <strong><span id="d_name"></span></strong>?');
      $('.btn-ok').removeClass('btn-primary');
      $('.btn-ok').addClass('btn-danger');
      $('.btn-text').html('Deactivate');
    }else{
      $('.titl').html('Activate course');
      $('.t-body').html('Are you sure want to activate <strong><span id="d_name"></span></strong>?');
      $('.btn-ok').removeClass('btn-danger');
      $('.btn-ok').addClass('btn-primary');
      $('.btn-text').html('Active');
    }
    $('#d_id').val(id);
    $('#d_name').html(course);
    $('#d_status').val(status);
  });
</script>

<script type="text/javascript">
   $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [[5, 6, 9, 12, -1], [5, 6, 9, 12, "All"]]
    });
   $('.select2').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

  $('#course').addClass('active3');
  $('#manage').addClass('menu-open');

  
</script>

@if ($message = Session::get('success'))
      <script type="text/javascript">
        toastr.success('{{ $message }}');
      </script>    
      
@endif
 
@endsection

