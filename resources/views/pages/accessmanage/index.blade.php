
@extends('layouts.header')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6 col-8 mb-2">
            <h5 class="m-0 text-dark"><strong> TMC - Clearance/Access Rights</strong></h5>
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
                <button type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New Permission</button>
                <table id="example2" class="table table-striped projects" >
                  <thead>
                    <tr>
                      <div class="row">
                        <div class="col-lg-8">
                          <th>
                            <h5><strong>List of Permission</strong></h5>
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
                    @foreach($permiss as $p)
                      <tr>
                        <td>
                          {{$p->name}}
                        </td>
                        <td>
                           <a class="" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item edit" href="#" data-id="{{$p->id}}" data-name="{{$p->name}}" data-toggle="modal" data-target="#modal-add" >Update</a>
                                <a class="dropdown-item delete" data-toggle="modal" data-id="{{$p->id}}" data-status="{{$p->status}}" data-name="{{$p->name}}" data-target="#modal-delete"  href="#"><?php echo($p->status == '1')? 'Deactivated' : 'Active' ?></a>
                              </div>
                        </td>
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
                <h5><strong>Access Role</strong></h5> 
                
                <div class="row">
                  <div class="col-lg-3 mt-4">
                    <select class="form-control form-control-sm" name="role" id="g_id">
                      <option value="1">Admin</option>
                      <option value="2">User</option>
                    </select>
                  </div>
                 
                </div>
                  <div class="row" id="display_">

                 
                  </div>
             
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div>
        </div>
      </div>
      


    </section><!-- /.content -->
  </div>

  <div class="modal fade" id="modal-role-add">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Access Right</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
        
        <div class="modal-body">
          <div class="form-group">
            <label>User type</label>
            <select class="form-control" name="type" id="type">
              <option value="">Select</option>
              <option value="1">Admin</option>
              <option value="2">User</option>
            </select>
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="access_right" class="form-control" id="access_right">
          </div>
          <div class="form-group">
            <label>Row</label>
            <input type="text" class="form-control" name="row" id="_row">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>

        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Access Right</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       <form id="frm_per" action="{{route('new_per')}}" method="POST"> 
        @csrf
         <div class="modal-body">
          <input type="hidden" name="id" id="u_id" value="0">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="access_right" class="form-control" id="access_right1" >
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


  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span class="_status"></span> Access Right</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{route('delete_per')}}" method="POST">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="id" id="_id">
            <label>Do you want to <span class="_status"></span> <span id="name_"> </span>?</label>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



<script type="text/javascript">
  $('#frm_per').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success  : function(data) {
         
             if (data.result == "1") {
              $('#modal-add').modal('hide');
              toastr.success(data.success);
              setTimeout(function () {
                location.reload();
              },1000)
             }else{
              toastr.error(data.error);
              
             }
        },error : function(err) {
          console.log(err);
        }
    });

  });
</script>
<script type="text/javascript">
  
</script>
<script type="text/javascript">
  $('.delete').click(function() {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var _status = $(this).attr('data-status');
    var status = "1";
    var de = "active";
    if (_status == "1") {
      status = "0";
      de = "deactivated";
    }

    $('#_id').val(id);
    $('#name_').html(name);
    $('._status').html(de);

  })
</script>
<script type="text/javascript">
      
  // display_
  $.ajax({
      url: "/get_all/" + $('#g_id').val(),
      method: "GET",
      cache:false,
      dataType:'json',
      success : function(data){ 

      var str = '';

      for (var i = 0; i < data.length; i++) {

        if (data[i].sig == "1") {
           str += '<div class="col-lg-4 mt-4"> <input type="checkbox" name="chk_bx" checked class="checkbox_update" data-id="'+data[i].r_id+'" value="'+data[i].r_id+'"> '+data[i].name+'</div>'
        }else{
           str += '<div class="col-lg-4 mt-4"> <input type="checkbox" name="chk_bx" class="checkbox_update" data-id="'+data[i].r_id+'"  value="'+data[i].r_id+'"> '+data[i].name+'</div>'
        }
       
      }

      $('#display_').html(str);
        
      },error : function(err){
        console.log(err);
        
      }
      
  });

  $('#g_id').change(function() {
    $.ajax({
      url: "/get_all/" + $(this).val(),
      method: "GET",
      cache:false,
      dataType:'json',
      success : function(data){ 

      var str = '';

      for (var i = 0; i < data.length; i++) {

        if (data[i].sig == "1") {
           str += '<div class="col-lg-4 mt-4"> <input type="checkbox" name="chk_bx" checked class="checkbox_update" data-id="'+data[i].r_id+'"  value="'+data[i].r_id+'"> '+data[i].name+'</div>'
        }else{
           str += '<div class="col-lg-4 mt-4"> <input type="checkbox" name="chk_bx" class="checkbox_update" data-id="'+data[i].r_id+'"  value="'+data[i].r_id+'"> '+data[i].name+'</div>'
        }
       
      }

      $('#display_').html(str);
        
      },error : function(err){
        console.log(err);
        
      }
      
    });
  });

  


</script>
<script type="text/javascript">
  
  $( document ).on( "change",":checkbox", function () {
    $.ajax({
        url: "/check_sig/" + $(this).val(),
        method: "GET",
        cache:false,
        dataType:'json',
        success : function(data){ 
          
              toastr.success(data.success);
              setTimeout(function () {
                location.reload();
              },1000)
          
        },error : function(err){
          console.log(err);
          
        }
      
      });
    // alert( "Handler for "+$(this).val()+" called." );
  });
</script>
<script type="text/javascript">
  $('.edit').click(function() {
      var id = $(this).attr('data-id');
      var name = $(this).attr('data-name');
      $('#u_id').val(id);
      
      $('#access_right1').val(name);


  })
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

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    $('#access_right').addClass('active3');

  
</script>

@if ($message = Session::get('success'))
      <script type="text/javascript">
        toastr.success('{{ $message }}');
      </script>    
      
@endif
 
@endsection

