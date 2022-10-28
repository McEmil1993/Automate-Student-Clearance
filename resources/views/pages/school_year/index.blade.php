@extends('layouts.header')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6 col-8 mb-2">
            <h5 class="m-0 text-dark"><strong> TMC - Clearance/Manage Others/School Year</strong></h5>
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
            <button type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New School Year</button>
            <table id="example2" class="table table-striped projects" >
              <thead>
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <th>
                        <h5><strong>List of School Year</strong></h5>
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
                @foreach($SchoolYear as $SchoolYears)
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <td>
                        <strong>{{$SchoolYears->school_year}} <?php echo ($SchoolYears->status == "1")? ' - '. $SchoolYears->semester.' semester' : ''; ?></strong> 
                      </td>
                    </div>
                    <div class="col-lg-2">
                      <td>
                        <div class="time-label">
                          <?php echo ($SchoolYears->status == "1")? ' <strong style="color:#28a745;">Active</strong>' : '<strong  style="color:#dc3545;">Unactive</strong>'; ?>
                          
                        </div>
                      </td>
                    </div>
                    <div class="col-lg-2">
                      <td class="project-actions">
                        <a class="" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit" href="#" data-id="{{$SchoolYears->id}}" data-school_year="{{$SchoolYears->school_year}}" data-status="{{$SchoolYears->status}}" data-semester="{{$SchoolYears->semester}}" data-toggle="modal" data-target="#modal-update" >Update Info</a>
                            <a class="dropdown-item delete" data-toggle="modal" data-target="#modal-delete" data-id="{{$SchoolYears->id}}" data-school_year="{{$SchoolYears->school_year}}" href="#">Delete</a>
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
          <h4 class="modal-title">New School Year</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('SchoolYear_add') }}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>School Year</label>
            <input type="text" name="school_year" class="form-control" placeholder="Enter School Year" required>
          </div>
          <!-- <div class="form-group">
            <label>Status</label>
             <select class="form-control " name="status" style="width: 100%;" required>
                <option selected disabled>Select status</option>
                <option value="1">Active</option>
                <option value="0">Unactive</option>
              </select>
          </div> -->
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
          <h4 class="modal-title">Update School Year</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('SchoolYear_update')}}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>School Year</label>
            <input type="hidden" class="e_id" name="id" id="e_id" >
            <input type="text" name="school_year" id="e_school_year" class="form-control e_school_year" placeholder="Enter year level" required>
          </div>
          <div class="form-group">
            <label>Semester</label>
             <select class="form-control semester" id="semester" name="semester" style="width: 100%;" required>
                <option selected disabled>Semester</option>
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="Summer">Summer</option>
              </select>
          </div>
          <div class="form-group">
            <label>Status</label>
             <select class="form-control e_status" id="status" name="status" style="width: 100%;" required>
                <option selected disabled>Select status</option>
                <option class="opt1" value="1">Active</option>
                <option class="opt0" value="0">Unactive</option>
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
          <h4 class="modal-title">Delete school_year</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('SchoolYear_delete')}}" method="POST">
          @csrf
        <div class="modal-body">
          <center>
            <input type="hidden" name="id" id="d_id">
            <h6>Are you sure want to delete <strong><span id="d_name"></span></strong>?</h6>
          </center>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
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
    var school_year = $(this).attr('data-school_year');
    var status = $(this).attr('data-status');
    var semester = $(this).attr('data-semester');

    $('.e_id').val(id);
    $('#e_school_year').val(school_year);
    $(".semester option[value='" + semester + "']").prop("selected", true).trigger('change');
    $(".e_status option[value='" + status + "']").prop("selected", true).trigger('change');


  });

  $('.delete').click(function (){
    var id = $(this).attr('data-id');
    var school_year = $(this).attr('data-school_year');
    // var status = $('.edit').attr('data-status');

    $('#d_id').val(id);
    $('#d_name').html(school_year);
    // $('.e_status').val(status);

  });
</script>
<script type="text/javascript">
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false
    });
   $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  $('#school_year').addClass('active3');
  $('#manage').addClass('menu-open');
</script>

@if ($message = Session::get('success'))
      <script type="text/javascript">
        toastr.success('{{ $message }}');
      </script>    
      
@endif
 
@endsection



