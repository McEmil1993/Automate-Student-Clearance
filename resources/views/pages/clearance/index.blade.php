
@extends('layouts.header')

@section('content')
<style type="text/css">
 
ul.avatars {
    display: flex;
    padding: 0;
    list-style: none;

}
ul{
  margin-top: 0;
    margin-bottom: 1rem;
}

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6 mb-2">
            <h1 class="m-0 text-dark"><strong> TMC - Clearance/Clearance</strong></h1>
          </div><!-- /.col -->
          <div class="col-lg-6 col-4">
            <div class="breadcrumb float-right">
              <h6s class="breadcrumb-item">School Year : <span style="color:green;">{{Session::get('school_year')}}</span> | {{Session::get('semester')}} Semester</h6>
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
          <!-- <div class="card-header">
            
          </div>  -->   
          <div class="card-body pl-2 pr-2">
            <table id="example6" class="table table-striped projects">
              <thead>
                <tr>
                  <th width="1%">
                    <div class="icheck-primary">
                      <input type="checkbox" value="<?php echo($sign_count1 == $sign_count2)? '0' : '1'; ?>" <?php echo($sign_count1 == $sign_count2)? 'checked="checked"' : ''; ?> id="check">
                      <label for="check"></label>
                    </div>
                  </th>
                  <th>
                    <h5><strong>List of Student Clearance</strong></h5>
                  </th>
                  <th></th>
                  <th></th>
                  <th>
                    <h5><strong>Signs</strong></h5>
                  </th>
                  <th>
                    <h5><strong>Action</strong></h5>
                  </th>
                </tr>
              </thead>
              <tbody id="list-wrapper">
                @php $students = App\Http\Controllers\ClearanceController::student_clearance();  @endphp
                
                @foreach($students as $studentss)

                <tr>
                  <td>
                    @php $ck = App\Http\Controllers\ClearanceController::get_assignee(Auth::user()->id,$studentss->ct);  @endphp

                    <div class="icheck-primary">
                      <input type="checkbox" class="check_change" <?php echo(Auth::user()->id == $ck->assignee_id)? 'checked ="checked"':''; ?> value="{{$ck->id}}" data-name="{{$studentss->fullname}}" id="check{{$studentss->c_id}}">
                      <label for="check{{$studentss->c_id}}"></label>


                     
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-md-12">
                        <img alt="Avatar" class="table-avatar " src="{{asset($studentss->profile_image)}}">

                        <b >{{$studentss->fullname}} - </b><strong >{{$studentss->course}} - {{$studentss->year_level}}</strong>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <span>{{$studentss->contact}} - {{$studentss->address}}</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="time-label">
                      @php $ui = App\Http\Controllers\ClearanceController::getUserByID($studentss->ct);  @endphp
                      <?php 
                  
                          if(count($ui) == 6) { 
                            ?>
                            <strong style="font-size: 20px;">-></strong> <span class="nt{{$ck->id}}"><strong class="badge badge-success "> Cleared</strong></span>
                            <?php
                          }else{
                             ?>
                             <strong style="font-size: 20px;">-></strong> <span class="nt{{$ck->id}}"><strong class="badge badge-danger "> Not Cleared</strong></span>
                            
                            <?php
                          }

                        ?> 
                      
                      
                    </div>
                  </td>
                  <td>
                    <ul class="navbar-nav ml-auto"><!-- Messages Dropdown Menu -->
                      <li class="nav-item dropdown show">
                        <a class="nav-link mess" data-toggle="modal"  data-target="#msgs" href="#" data-id="{{$ck->id}}" data-student="{{$studentss->ct}}" data-chat="{{$studentss->chat_st}}" aria-expanded="true">
                          <i class="far fa-comment" style="font-size: 25px"></i>
                        </a>
                      </li>
                    </ul>
                  </td>
                  <td>
                    <ul class="avatars" id="avatars{{$ck->id}}">

                      
                        <?php 
                  
                          for ($i=0; $i < count($ui); $i++) { 
                            ?>

                            <li>
                              <a href="#" title="{{$ui[$i]['fullname']}}">
                                <img alt="Avatar" class="table-avatar" style="border: 1px solid #7c7c7d;" src="{{asset($ui[$i]['H'])}}">
                              </a>
                            </li>
                            

                            <?php
                          }

                        ?>

                    </ul>
                   
                  </td>
                  <td class="project-actions">
                    <a class="btn btn-primary c_status"  data-toggle="modal" data-target="#c_status" href="#" data-img="{{asset($studentss->profile_image)}}" data-name="{{$studentss->fullname}}" data-course="{{$studentss->course}} - {{$studentss->year_level}}" data-id="{{$studentss->ct}}"><i class="fas fa-inbox"></i></a>
                  </td>
                </tr>


                

                @endforeach
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.card -->
    </section><!-- /.content -->
  </div>

  <div class="modal fade" id="c_status">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" >
        
        <div class="modal-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle pro"
                 src=""
                 alt="profile">
          </div>

          <h3 class="profile-username text-center tname">Nina Mcintire</h3>

          <p class="text-muted text-center tcourse">Software Engineer</p>

          <ul class="list-group list-group-unbordered mb-3 list_" >

        
          </ul>

          <a href="#"  class="btn btn-danger btn-block"  data-dismiss="modal">Close</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Messages Modal -->
  <div class="modal fade" id="msgs" data-backdrop="static" keyboard="false">
    <div class="modal-dialog" >
      <div class="modal-content" style="background-color: #fff; border-radius: 10px">
        <div class="modal-header" style="border-color: maroon">
          <h5 class="modal-title"><strong>Messages</strong></h5> <input type="checkbox" name="student_id" id="unable_student" style="margin-left: 20px;margin-top: 11px;"> <span id="" style="margin-top: 5px; margin-left: 4px;"> Disabled to reply</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

          <div class="box" style="background-color: #f0eded;">
            <div class="card-body">
             <div class="direct-chat-messages" style="border: 1px solid lightgray;height:400px;overflow: auto;"> <!-- Conversations are loaded here -->
                <!-- Message to the right -->
                <div id="display_data">
                   
                </div>

              </div><!--/.direct-chat-messages-->
              <form action="{{route('send_message')}}" method="post" id="send_mess" class="send_mess mt-2">
                @csrf
                <div class="input-group">
                  <input type="hidden" name="clearance_id" class="clearance_id" value="">
                  <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                  <textarea name="message" placeholder="Type Message ..." class="form-control" id="message"></textarea>
               
                  <span class="input-group-append">
                    <button type="submit" id="send" class="btn btn-primary">Send</button>
                  </span>
                </div>
              </form>

            </div>
          </div>
         
       
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.Messagesmodal -->

<script type="text/javascript">

  $('#unable_student').click(function() {

    var id = $(this).val();
    var status = "";
    if ($(this).is(":checked")) {
      status = "0";
    }else{
      status = "1";
    }

    $.ajax({
          url: "/edit_chat_status/"+id,
          method: "GET",
          data :{status:status},
          cache:false,
          success : function(data){

            // location.reload();
             toastr.success(data);
            
          },error : function(err){
            console.log(err);
            
          }
          
      });

  })
</script>
<script type="text/javascript">
   $('.mess').click(function(){
    var st = $(this).attr('data-student');
    var id = $(this).attr('data-id');
    var chat = $(this).attr('data-chat');
    if (chat == "1") {
      $('#unable_student').prop("checked", false);
    }else{
      $('#unable_student').prop("checked", true);
    }
     
    $('#unable_student').val(st);
    $('.clearance_id').val(id);
    function_name(id);

   });
    
 </script>
 <script type="text/javascript">
    $('#send_mess').on('submit',function(e){
        e.preventDefault();
        var id = $('.clearance_id').val();
        $.ajax({
            type     : "POST",
            cache    : false,
            url      : $(this).attr('action'),
            data     : $(this).serialize(),
            success  : function(data) {
              // alert(data.success);
              $('textarea').val('');
              toastr.success('Send success!');
              function_name(id);

              
              
            
            },error  : function(ok) {
              console.log(ok);
            }
        });

    });
  </script>
  <script type="text/javascript">
  $(function() {
    // ID selector on Master Checkbox
    var masterCheck = $("#check");
    // ID selector on Items Container
    var listCheckItems = $("#list-wrapper :checkbox");

    // Click Event on Master Check
    masterCheck.on("click", function() {
      var isMasterChecked = $(this).is(":checked");
      listCheckItems.prop("checked", isMasterChecked);
      getSelectedItems();

      var id = $(this).val();
     
      $.ajax({
          url: "/check_all/"+id,
          method: "GET",
          data :{id:id},
          cache:false,
          dataType:'json',
          success : function(data){

            location.reload();
            
          },error : function(err){
            console.log(err);
            
          }
          
      });
    });

    // Change Event on each item checkbox
    listCheckItems.on("change", function() {
      // Total Checkboxes in list
      var totalItems = listCheckItems.length;
      // Total Checked Checkboxes in list
      var checkedItems = listCheckItems.filter(":checked").length;

      //If all are checked
      if (totalItems == checkedItems) {
        masterCheck.prop("indeterminate", false).trigger('change');
        masterCheck.prop("checked", true).trigger('change');
      }
      // Not all but only some are checked
      else if (checkedItems > 0 && checkedItems < totalItems) {
        masterCheck.prop("indeterminate", true).trigger('change');
      }
      //If none is checked
      else {
        masterCheck.prop("indeterminate", false).trigger('change');
        masterCheck.prop("checked", false).trigger('change');
      }
      getSelectedItems();
    });



    function getSelectedItems() {
      var getCheckedValues = [];
      getCheckedValues = [];
      listCheckItems.filter(":checked").each(function() {
        getCheckedValues.push($(this).val());
      });
      $("#selected-values").html(JSON.stringify(getCheckedValues));
    }

    
  });
</script>
<script type="text/javascript">
  $('.check_change').on('click',function() {

    var name = $(this).attr('data-name');

    var id = $(this).val();
    $.ajax({
        url: "/update_sig/"+id,
        method: "GET",
        data :{id:id},
        cache:false,
        dataType:'json',
        success : function(data){

          if (data.length == 0) {
            $("#avatars"+id).html('');
          }else{
            var tx = "";
            for (var i = 0; i < data.length; i++) {
              tx +='<li><a href="#" title="'+data[i].fullname+'"><img alt="Avatar" class="table-avatar" style="border: 1px solid #7c7c7d;" src="'+data[i].H+'")}}"></a></li>';
              
            }
            $("#avatars"+id).html(tx);
            if(data.length == 6) { 
              $('.nt'+id).html('<span class="nt'+id+'"><strong class="badge badge-success "> Cleared</strong></span>');
            }else{
               $('.nt'+id).html('<span class="nt'+id+'"><strong class="badge badge-danger">Not Cleared</strong></span>');
            }
          }
        },error :function(er){
          console.log(er);
        }
        
    });


  });
</script>

 <script type="text/javascript">

  // $('#check').click(function() {
  //  var checked = $(this).prop('checked');
  //  $('.icheck-primary').find('input:checkbox').prop('checked', checked);

  
  // });

 $('.c_status').click(function() {
   var img = $(this).attr('data-img');
   var fname = $(this).attr('data-name');
   var c_y = $(this).attr('data-course');
   var id = $(this).attr('data-id');

    $('.pro').attr('src',img);
    $('.tname').html(fname);
    $('.tcourse').html(c_y);

    
    $.ajax({
        url: "/get_sig/"+id,
        method: "GET",
        cache:false,
        dataType:'json' ,
        success : function(data){

          console.log(data.length);
          if (data.length == 0) {
            $('.list_').html('<li class="list-group-item text-center">No sign <a class="float-right"><strong></strong> </a></li>');
          }else{
            var tx = "";
            for (var i = 0; i < data.length; i++) {
              tx +='<li class="list-group-item"><b>'+data[i].nm+'</b> <a class="float-right"><strong><i class="fas fa-check" style="color: green"></i></strong> </a></li>';
              
            }
            $('.list_').html(tx);
          }
          
          

        },error :function(er){
          console.log(er);
        }
        
    });

 });
 

  


 </script>
 
  <script type="text/javascript">
    

  function function_name(id) {
  
    $.ajax({
        type     : "GET",
        cache    : false,
        url      :'/display/'+ id,
        dataType : 'JSON',
        success  : function(data) {
          // console.log(data);
        var str = "";
        if (data.length > 0) {
          for (var i = 0; i < data.length; i++) {
          
          if (data[i].user_id == '{{Auth::user()->id}}') {
                   
             str += '<div class="direct-chat-msg right"> <div class="direct-chat-infos clearfix"> <span class="direct-chat-name float-right"></span> <span class="direct-chat-timestamp float-left">'+data[i].datetime_mess+'</span> </div><img class="direct-chat-img" src="{{asset(Auth::user()->image)}}" alt="message user image"><div class="direct-chat-text" > '+data[i].message+ '</div> </div>';
          }else{
            str += ' <div class="direct-chat-msg m-4">      <div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">'+data[i].name+'</span><span class="direct-chat-timestamp float-right">'+data[i].datetime_mess+'</span></div> <img class="direct-chat-img" src="'+data[i].profile_image+'" alt="message user image">    <div class="direct-chat-text" >   '+data[i].message+'</div> </div>  ';
          }
         }
        }else{
              str += '<center><p>No message.</p></center>';       
        }
         
         $('#display_data').html(str);


        },error  : function(ok) {
          console.log(ok);
        }
    });
  }
  </script>
  

  <script>
   
     $('#clearance').addClass('active3');

    
</script>
<script type="text/javascript">
  $('#example6').DataTable({
      "paging": true,
      "lengthChange": false
    });
</script>


 
  @endsection

