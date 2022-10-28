
@extends('layouts.header')

@section('content')
<style type="text/css">
  .select2-selection--single{
    height: 38px;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6 col-8 mb-2">
            <h5 class="m-0 text-dark"><strong> TMC - Clearance/Manage Others/Student</strong></h5>
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
            <button type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New Student</button>
            <table id="example2" class="table table-striped projects" >
              <thead>
                <tr>
                  
                      <th>
                        <h5><strong>List of Student </strong></h5> 
                      </th>
                    
                      <th>
                        <h5><strong>Status</strong></h5>
                      </th>
                    </div>
                    <th>
                        <h5><strong>Action</strong></h5>
                      </th>
                    
                </tr>
              </thead>
              <tbody>
                @foreach($students as $studentss)
                <tr>
                  
                      <td>
                        <div class="user-panel  d-flex">
                            <div class="image mt-2">
                                <img src="{{asset($studentss->profile_image)}}" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info" >
                                <strong> {{$studentss->fullname}}</strong> - {{$studentss->course}} - {{$studentss->year_level}}<br>
                                <small>{{$studentss->contact}} - {{$studentss->address}}</small>
                            </div>
                        </div>
                      </td>
                    
                      <td>
                        <div class="time-label">

                          <?php echo ($studentss->st == "1")? '<strong style="color:#28a745;">Active</strong>' : '<strong  style="color:#dc3545;">Unactive</strong>'; ?>
                          
                        </div>
                      </td>
                    
                      <td class="project-actions">
                        <a class="cto" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit" href="#" data-id="{{$studentss->D}}" data-toggle="modal" data-target="#modal-update" >Update Info</a>
                            <a class="dropdown-item u_st" href="#" data-id="{{$studentss->D}}" data-name="{{$studentss->fullname}}" data-status="{{$studentss->st}}" data-toggle="modal" data-target="#modal-status" >Update status</a>
                            <a class="dropdown-item delete" data-toggle="modal" data-target="#modal-delete" data-id="{{$studentss->D}}" data-name="{{$studentss->fullname}}" href="#">Delete</a>
                          </div>
                      </td>
                    
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title ">New Student</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('student_add') }}" method="POST" role="form" enctype="multipart/form-data" id="students-form">
          @csrf
        <div class="modal-body">
          <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="firstname"  value="{{ old('firstname') }}" class="form-control  @error('firstname') is-invalid @enderror"  placeholder="Firstname" >
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="middlename"  value="{{ old('middlename') }}" class="form-control @error('middlename') is-invalid @enderror" placeholder="Middlename" >
                    @error('middlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                 </div>

                 <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="lastname"  value="{{ old('lastname') }}" class="form-control @error('lastname') is-invalid @enderror" placeholder="Lastname" >
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control  suffix" name="suffix" >
                      <option disabled selected="selected">Suffix</option>
                      <option value="Sr">Sr</option>
                      <option value="Jr">Jr</option>
                      <option value="III">III</option>
                      <option value="IV">IV</option>
                      <option value="V">V</option>
                      <option value="VI">VI</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('course') is-invalid @enderror"  value="{{ old('course') }}" name="course"  >
                      <option value="" selected="" disabled="">Course</option>
                      @foreach($course as $courses)
                      @if(old('course') == $courses->id)
                          <option <?php echo 'selected' ?> value="{{$courses->id}}">{{$courses->course}}</option>
                       @else
                          <option  value="{{$courses->id}}">{{$courses->course}}</option>
                       @endif
                      @endforeach
                    </select>
                    @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('year_level') is-invalid @enderror"  name="year_level" >
                      <option value="" selected="" disabled="">Year level</option>
                       @foreach($year_level as $year_levels)
                       @if(old('year_level') == $year_levels->id)
                          <option <?php  echo 'selected' ?> value="{{$year_levels->id}}">{{$year_levels->year_level}}</option>
                       @else
                          <option  value="{{$year_levels->id}}">{{$year_levels->year_level}}</option>
                       @endif
                      
                      @endforeach
                    </select>
                    @error('year_level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('status') is-invalid @enderror" value="{{ old('status') }}" name="status" >
                      <option  selected="" disabled="">Status</option>
                      @if(old('status') == "1")
                        <option <?php echo 'selected' ?> value="1">Active</option>
                        <option value="0">Deactived</option>
                       @elseif(old('status') == "0")
                        <option value="1">Active</option>
                        <option <?php echo 'selected' ?> value="0">Deactived</option>

                       @else
                        <option value="1">Active</option>
                        <option value="0">Deactived</option>

                       @endif
                      
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="student_id"  value="{{ old('student_id') }}" class="form-control  @error('student_id') is-invalid @enderror" placeholder="Student id" >
                    @error('student_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input type="number" name="contact"  value="{{ old('contact') }}" class="form-control  @error('contact') is-invalid @enderror" placeholder="Contact Ex.(+63912345678)" >
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                     <div class="col-lg-12">
                      <div class="form-group">
                        <div class="custom-file">
                          <input type="hidden" name="student_profile1" class="u_sig" value="{{ old('student_profile') }}"> 
                          <input type="file" name="student_profile" id="sigImg" value="{{ old('student_profile') }}" class="custom-file-input sigImg">
                          <label class="custom-file-label sig" for="customFile">Student Profile {{ old('student_profile') }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <textarea class="form-control @error('address') is-invalid @enderror"  rows="3" name="address" placeholder="Address" style="height: 93px;">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email')  is-invalid @enderror"   value="{{ old('email') }}"placeholder="Email">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  
                </div>
                 <div class="col-lg-6">
                  <div class="input-group mb-3" >
                    <input type="password" name="password" placeholder="Password"  value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append eye" style="cursor: pointer;" data-i="1">
                      <span class="input-group-text"><i class="fas fa-eye p"></i></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  
                </div>


              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Save</button>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title ">Update Student</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('student_update') }}" method="POST" role="form" enctype="multipart/form-data" id="students-form_update">
          @csrf
        <div class="modal-body">
          <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="hidden" name="id" id="e_id">
                    <input type="text" name="firstname"  class="form-control" id="e_firstname"  placeholder="Firstname" >
                    <span class="invalid-feedback" role="alert" id="e_firstname_error"></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="middlename"  class="form-control" id="e_middlename" placeholder="Middlename" >
                        <span class="invalid-feedback" role="alert">
                            
                        </span>
                    
                  </div>
                 </div>

                 <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="lastname"  class="form-control " id="e_lastname" placeholder="Lastname" >
                   
                        <span class="invalid-feedback" role="alert" id="e_lastname_error">
                          
                        </span>
                   
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control  suffix" name="suffix" id="e_suffix">
                      <option disabled selected="selected">Suffix</option>
                      <option value="Sr">Sr</option>
                      <option value="Jr">Jr</option>
                      <option value="III">III</option>
                      <option value="IV">IV</option>
                      <option value="V">V</option>
                      <option value="VI">VI</option>
                    </select>
                    <span class="invalid-feedback" role="alert" id="e_suffix_error">
                            
                        </span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control" id="e_course" name="course"  >
                      <option value="" selected="" disabled="">Course</option>
                      @foreach($course as $courses)
                      
                        <option  value="{{$courses->id}}">{{$courses->course}}</option>
                       
                      @endforeach
                    </select>
                    
                        <span class="invalid-feedback" role="alert" id="e_course_error">
                            
                        </span>
                   
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control"  name="year_level" id="e_year_level">
                      <option value="" selected="" disabled="">Year level</option>
                       @foreach($year_level as $year_levels)
                       
                        <option  value="{{$year_levels->id}}">{{$year_levels->year_level}}</option>
                   
                      @endforeach
                    </select>
                        <span class="invalid-feedback" role="alert" id="e_year_level_error">

                        </span>
                    
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control " name="status" id="e_status">
                      <option  selected="" disabled="">Status</option>
                      <option value="1">Active</option>
                      <option value="0">Deactived</option>
                    </select>
                        <span class="invalid-feedback" role="alert" id="e_status_error">
                            
                        </span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="student_id" id="e_student_id" class="form-control " placeholder="Student id" >
                   
                        <span class="invalid-feedback" role="alert" id="e_student_id_error">
                            
                        </span>
                  
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input type="number" name="contact" id="e_contact" class="form-control " placeholder="Contact Ex.(+63912345678)" >
                       
                        <span class="invalid-feedback" role="alert" id="e_contact_error">
                           
                        </span>
                       
                      </div>
                    </div>
                     <div class="col-lg-12">
                      <div class="form-group">
                        <div class="custom-file">
                          <input type="hidden" name="student_profile1" class="u_sig " > 
                          <input type="file" name="student_profile" id="sigImg" class="custom-file-input sigImg">
                          <label class="custom-file-label sig" for="customFile">Student Profile </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <textarea class="form-control @error('address') is-invalid @enderror" id="e_address" rows="3" name="address" placeholder="Address" style="height: 93px;"></textarea>
                        <span class="invalid-feedback" role="alert" id="e_address_error">
                            
                        </span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" id="e_email" placeholder="Email">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    
                        <span class="invalid-feedback" role="alert" id="e_email_error">
                           
                        </span>
                   
                  </div>
                  
                </div>
                 <div class="col-lg-6">
                  <div class="input-group mb-3" >
                    <input type="password" name="password" placeholder="Password"  class="form-control " id="e_password">
                    <div class="input-group-append eye" style="cursor: pointer;" data-i="1">
                      <span class="input-group-text"><i class="fas fa-eye p"></i></span>
                    </div>
                        <span class="invalid-feedback" role="alert" id="e_password_error">
                           
                        </span>
                  </div>
                  
                </div>


              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Save</button>
        </div>
       </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--modal End -->

  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Delete Assignee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('student_delete')}}" method="POST">
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

  <div class="modal fade" id="modal-status">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title tl" >Update Status</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('student_status')}}" method="POST">
          @csrf
        <div class="modal-body">
          <center>
            <input type="hidden" name="id" id="s_id">
            <input type="hidden" name="status" id="s_st">
            <h6>Are you sure want to <span class="tb"></span> <strong><span id="s_name"></span></strong>?</h6>
          </center>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Yes</button>
        </div>
       </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<script type="text/javascript">
 
   $('.edit').click(function (e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
        url: "/get_student/"+id,
        method: "GET",
        data :{id:id},
        cache:false,
        dataType:'json' ,
        success : function(data){

          var prefix = data.prefix;
          var suffix = data.suffix;
          $('#e_id').val(id);
          $('#e_firstname').val(data.firstname);
          $('#e_lastname').val(data.lastname);
          $('#e_middlename').val(data.middlename);
          $('#e_student_id').val(data.student_id);
          // $.each(prefix.split(","), function(i,e){
          //     $("#prefix option[value='" + e + "']").prop("selected", true).trigger('change');
          // });
          // $.each(suffix.split(","), function(i,e){
          //     $("#suffix option[value='" + e + "']").prop("selected", true).trigger('change');
          // });
          $("#e_status option[value='" + data.status + "']").prop("selected", true).trigger('change');
          $("#e_course option[value='" + data.course + "']").prop("selected", true).trigger('change');
          $("#e_year_level option[value='" + data.year_level + "']").prop("selected", true).trigger('change');
          $("#e_suffix option[value='" + data.suffix + "']").prop("selected", true).trigger('change');
          $("#signature_assign option[value='" + data.signature_assign + "']").prop("selected", true).trigger('change');
          $('#e_contact').val(data.contact);
          $('#e_address').html(data.address);
          $('#e_email').val(data.email);
        
        }
        
    });
  });

  $('.delete').click(function (){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    // var status = $('.edit').attr('data-status');

    $('#d_id').val(id);
    $('#d_name').html(name);
    // $('.e_status').val(status);

  });
 $('.sigImg').on('change',function() {
  // C:\fakepath\exmedicine.jpg
   var v = $(this).val();
   var itemId = v.substring(12);
       
   $('.sig').html(itemId);
   $('.u_sig').val(v);
 });
 $('.u_st').click(function (){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var status = $(this).attr('data-status');
     if (status == "1") {
      $('.tl').html('Deactivate status');
      $('.tb').html('deactivate status ');
      $('#s_st').val('0');
    }else{
      $('.tl').html('Activate status');
      $('.tb').html('activate status ');
      $('#s_st').val('1');
    }
    $('#s_id').val(id);
    $('#s_name').html(name);
    

  });

</script>

  <!--modal End -->
  <script type="text/javascript">
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "1500",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#students-form_update').on('submit', function(event){
        event.preventDefault();

        $('#e_email').removeClass('is-invalid');
        $('#e_email_error').text('');
        // $('#mobile-number-error').text('');
        // $('#subject-error').text('');
        // $('#message-error').text('');
        var formData = new FormData($(this)[0]);

        $.ajax({
          type     : "POST",
          cache: false,
          contentType: false,
          processData: false,
          url      : $(this).attr('action'),
          data     : formData,
          
          success:function(response){
            $('#modal-update').modal('hide');
            // $('#m-load').modal('show');
            toastr["success"](response.success);        
            setTimeout(function() {
              window.location.reload();
            },1500);

               
          },
          error: function(response) {
            console.log(response);
            if ($('#e_email').val() == "") {
              $('#e_email').addClass('is-invalid');
            }
            
            $('#e_email_error').text(response.responseJSON.errors.email);
            $('#e_password').addClass('is-invalid');
            $('#e_password_error').text(response.responseJSON.errors.password);
          },

        
         });
        });

   
   </script>
  <script type="text/javascript">

      $('.bootstrap-select').selectpicker();
      
      $('#framework').change(function(){
        $('#hidden_suffix').val($('#framework').val());
      });
     
  
 </script>

<script type="text/javascript">
    // $('#example-multiple-selected').multiselect();
    $('.eye').on('click',function() {
      var id = $(this).attr('data-i');

      if (id == "1") {
        $('input[name="password"]').attr('type','text');
        $(this).attr('data-i','0');
        $('.p').removeClass('fa-eye');
        $('.p').addClass('fa-eye-slash');
      }else{
        $('input[name="password"]').attr('type','password');
        $(this).attr('data-i','1');
         $('.p').addClass('fa-eye');
        $('.p').removeClass('fa-eye-slash');
      }

    })
</script>
<!-- Note the missing multiple attribute! -->
<script type="text/javascript">
  $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>
<script type="text/javascript">
  // $('.prefix').val("1");
   $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
    });
   
  $('#students').addClass('active3');
  
 


</script>

@error('firstname')
 
@enderror
 @if ($errors->any())
  <script type="text/javascript">
    $('#modal-add').modal('show');
    $('#modal-add').attr('style','background-color:rgba(0, 0, 0,0.5)')
    
 </script>   
@endif


@if ($message = Session::get('success'))
      <script type="text/javascript">
        toastr.success('{{ $message }}');
      </script>    
      
@endif
 
@endsection

