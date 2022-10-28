@extends('layouts.header')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6 col-8 mb-2">
            <h5 class="m-0 text-dark"><strong> TMC - Clearance/Manage Others/Prefix - Suffix</strong></h5>
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
      <div class="row">
      <div class="col-lg-6">
        <div class="box p-2"><!-- Default box -->
        <div class="card">
        
          <div class="box-body" style="padding:10px">

            <button type="button" data-toggle="modal" data-target="#modal-add_prefix" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New Prefix</button>
            <table id="example2" class="table table-striped projects" >
              <thead>
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <th>
                        <h5><strong>List of Prefix</strong></h5>
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
                @foreach($prefix as $prefixs)
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <td>
                        <strong>{{$prefixs->prefix}} </strong><br>{{$prefixs->description}}
                      </td>
                    </div>
                   
                    <div class="col-lg-2">
                      <td class="project-actions">
                        <a class="" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit_prefiix" href="#" data-id="{{$prefixs->id}}" data-prefix="{{$prefixs->prefix}}" data-description="{{$prefixs->description}}" data-toggle="modal" data-target="#modal-update_prefiix" >Update Info</a>
                            <a class="dropdown-item delete_prefiix" data-toggle="modal" data-target="#modal-delete_prefiix" data-id="{{$prefixs->id}}" data-prefix="{{$prefixs->prefix}}" href="#">Delete</a>
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
      </div>
      <div class="col-lg-6">
        <div class="box p-2"><!-- Default box -->
        <div class="card">
        
          <div class="box-body" style="padding:10px">

            <button type="button" data-toggle="modal" data-target="#modal-add_suffix" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New Suffix</button>
            <table id="example3" class="table table-striped projects" >
              <thead>
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <th>
                        <h5><strong>List of Suffix</strong></h5>
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
                @foreach($suffix as $suffixs)
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <td>
                        <strong>{{$suffixs->suffix}} </strong><br>{{$suffixs->description}}
                      </td>
                    </div>
                   
                    <div class="col-lg-2">
                      <td class="project-actions">
                        <a class="" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit_suffix" href="#" data-id="{{$suffixs->id}}" data-suffix="{{$suffixs->suffix}}" data-description="{{$suffixs->description}}" data-toggle="modal" data-target="#modal-update_suffix" >Update Info</a>
                            <a class="dropdown-item delete_suffix" data-toggle="modal" data-target="#modal-delete_suffix" data-id="{{$suffixs->id}}" data-suffix="{{$suffixs->suffix}}" href="#">Delete</a>
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
      </div>
      
      </div>
    </section><!-- /.content -->
  </div>

  <!-- modal add -->
  <div class="modal fade" id="modal-add_prefix" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">New Prefix</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('prefix_add') }}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Prefix</label>
            <input type="text" name="prefix" class="form-control" placeholder="Enter prefix" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter description" required>
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

   <div class="modal fade" id="modal-add_suffix" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">New Suffix</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('suffix_add') }}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Suffix</label>
            <input type="text" name="suffix" class="form-control" placeholder="Enter suffix" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter description" required>
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
  <div class="modal fade" id="modal-update_prefiix" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Update Prefix</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('prefix_update') }}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Prefix</label>
            <input type="hidden" name="id" id="e_id">
            <input type="text" name="prefix" id="prefix" class="form-control" placeholder="Enter prefix" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" id="description_prefiix" class="form-control" placeholder="Enter description" required>
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


  <div class="modal fade" id="modal-update_suffix" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Update Prefix</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('suffix_update') }}" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Suffix</label>
            <input type="hidden" name="id" id="e_id_suffix" class="e_id_suffix">
            <input type="text" name="suffix" id="suffix" class="form-control suffix" placeholder="Enter suffix" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" id="description_suffix" class="form-control description_suffix" placeholder="Enter description" required>
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


   <div class="modal fade" id="modal-delete_prefiix" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Delete prefix</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('prefix_delete')}}" method="POST">
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


   <div class="modal fade" id="modal-delete_suffix" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Delete prefix</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('suffix_delete')}}" method="POST">
          @csrf
        <div class="modal-body">
          <center>
            <input type="hidden" name="id" id="d_id_suffix">
            <h6>Are you sure want to delete <strong><span id="d_name_suffix"></span></strong>?</h6>
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
  

  $('.edit_prefiix').click(function (){
    var id = $(this).attr('data-id');
    var prefix = $(this).attr('data-prefix');
    var description = $(this).attr('data-description');
    // var semester = $(this).attr('data-semester');

    $('#e_id').val(id);
    $('#prefix').val(prefix);
    $('#description_prefiix').val(description);
    // $('.e_status').val(status);

  });

  $('.delete_prefiix').click(function (){
    var id = $(this).attr('data-id');
    var prefix = $(this).attr('data-prefix');
    // var status = $('.edit').attr('data-status');

    $('#d_id').val(id);
    $('#d_name').html(prefix);
    // $('.e_status').val(status);

  });

  $('.edit_suffix').click(function (){
    var id = $(this).attr('data-id');
    var suffix = $(this).attr('data-suffix');
    var description = $(this).attr('data-description');
    // var semester = $(this).attr('data-semester');

    $('.e_id_suffix').val(id);
    $('.suffix').val(suffix);
    $('.description_suffix').val(description);
    // $('.e_status').val(status);

  });

  $('.delete_suffix').click(function (){
    var id = $(this).attr('data-id');
    var suffix = $(this).attr('data-suffix');
    // var status = $('.edit').attr('data-status');

    $('#d_id_suffix').val(id);
    $('#d_name_suffix').html(suffix);
    // $('.e_status').val(status);

  });
</script>

<script type="text/javascript">
   $('#example2').DataTable({
      "paging": true,
      "lengthChange": false
      
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false
    });
   $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  $('#pfix_sfix').addClass('active3');
  $('#manage').addClass('menu-open');
</script>

@if ($message = Session::get('success'))
      <script type="text/javascript">
        toastr.success('{{ $message }}');
      </script>    
      
@endif
 
@endsection



