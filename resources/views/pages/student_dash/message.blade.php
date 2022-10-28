
@extends('layouts.student_main')

@section('content')

 <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6"></div><!-- /.col -->
          <div class="col-lg-6 col-4">
            <div class="breadcrumb float-right">
              <h5 class="breadcrumb-item">School Year : <span style="color:green;">2021-2022</span></h5>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-7">
          <div class="card direct-chat direct-chat-primary m-2" style="height:100%;">
            <div class="card-body p-2" >
              <div class="direct-chat-messages" style="border: 1px solid lightgray;height:400px;"> 
                <!-- <div class="text-center"><p>No Message</p></div> -->

                <div id="display_data">
                   
                </div>

              </div><!--/.direct-chat-messages-->
              <form action="{{route('send_message')}}" method="post" class="send_mess mt-2">
                @csrf
                <div class="input-group">
                  <input type="hidden" name="clearance_id" id="clearance_id" value="">

                  <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                  <textarea name="message" placeholder="Type Message ..." class="form-control" id="message"></textarea>
               
                  <span class="input-group-append">
                    <button type="submit" id="send" class="btn btn-primary">Send</button>
                  </span>
                </div>
              </form>
            </div> <!-- /.card-body -->
            
            <!-- /.card-footer-->
          </div>
        </div>
        <div class="col-lg-5">
          <div class="box"><!-- Default box -->
            <div class="card m-2">
              <div class="card-body">
                <table class="table projects">
                  <thead>
                    <tr>
                      <th>
                        <h4><strong>List of Assign</strong></h4>
                      </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <input type="hidden" name="" id="cl_">
                    <?php $i=1; $str = ""; ?>
          	       @foreach($sig as $s)

                    @php $ge = App\Http\Controllers\StudentDashController::getAss($s->id);  @endphp
                    @if(!empty($ge)) 
                    @php $ui = App\Http\Controllers\StudentDashController::get(Auth::user()->id,$s->id);  @endphp
          	 	  	  <tr class="" id="active_{{$i++}}" data-id="@if(!empty($ui)){{$ui->g}}@endif" data-name="@if(!empty($ui)){{$ui->cc}}@endif">
                      <td>
                        <div class="row" style="cursor: pointer;" >
                          <div class="col-md-12">
                            <img alt="No image" class="table-avatar" src="{{asset($ge->H)}}">
                            <b>{{$ge->fullname}}</b>
                          </div>
                        </div>
                      </td>
                      
                    </tr>
                    
 					          @endif

                  
                    @endforeach
                   
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section>
  </div>

  <script type="text/javascript">
   $('#message').addClass('active3');
   $('#active_1').addClass('active3');
  </script>
  <script type="text/javascript">

    $('.send_mess').on('submit',function(e){
        e.preventDefault();
        
        $.ajax({
            type     : "POST",
            cache    : false,
            url      : $(this).attr('action'),
            data     : $(this).serialize(),
            success  : function(data) {
              // alert(data.success);
              if (data.result == "0") {

                  toastr.error('You are not abled to reply!');
              }else{
                  $('textarea').val('');
                  toastr.success('Send success!');
                  if ($('#cl_').val() == "") {

                    $('#cl_').val($('#active_1').attr('data-id'));
                    $('#clearance_id').val($('#active_1').attr('data-id'));
                  }
              
              
                // $.ajax({
                  $.ajax({
                      type     : "GET",
                      cache    : false,
                      url      :'/display/'+ $('#cl_').val(),
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
              
            },error  : function(ok) {
              console.log(ok);
            }
        });

    });
  </script>
 
 <script type="text/javascript">
function_name();
     $('#active_1').click(function() {

       $('#active_1').addClass('active3');
       $('#active_2').removeClass('active3');
       $('#active_3').removeClass('active3');
       $('#active_4').removeClass('active3');
       $('#active_5').removeClass('active3');
       $('#active_6').removeClass('active3');
       $('#cl_').val($('#active_1').attr('data-id'));
       $('#clearance_id').val($('#active_1').attr('data-id'));
       function_name();
     })
     $('#active_2').click(function() {
       $('#active_1').removeClass('active3');
       $('#active_2').addClass('active3');
       $('#active_3').removeClass('active3');
       $('#active_4').removeClass('active3');
       $('#active_5').removeClass('active3');
       $('#active_6').removeClass('active3');
       $('#cl_').val($('#active_2').attr('data-id'));
       $('#clearance_id').val($('#active_2').attr('data-id'));
       function_name();
     })
     $('#active_3').click(function() {
       $('#active_1').removeClass('active3');
       $('#active_2').removeClass('active3');
       $('#active_3').addClass('active3');
       $('#active_4').removeClass('active3');
       $('#active_5').removeClass('active3');
       $('#active_6').removeClass('active3');
       $('#cl_').val($('#active_3').attr('data-id'));
       $('#clearance_id').val($('#active_3').attr('data-id'));
       function_name();
     })
     $('#active_4').click(function() {
       $('#active_1').removeClass('active3');
       $('#active_2').removeClass('active3');
       $('#active_3').removeClass('active3');
       $('#active_4').addClass('active3');
       $('#active_5').removeClass('active3');
       $('#active_6').removeClass('active3');
       $('#cl_').val($('#active_4').attr('data-id'));
       $('#clearance_id').val($('#active_4').attr('data-id'));
       function_name();
     })
     $('#active_5').click(function() {
       $('#active_1').removeClass('active3');
       $('#active_2').removeClass('active3');
       $('#active_3').removeClass('active3');
       $('#active_4').removeClass('active3');
       $('#active_5').addClass('active3');
       $('#active_6').removeClass('active3');
       $('#cl_').val($('#active_5').attr('data-id'));
       $('#clearance_id').val($('#active_5').attr('data-id'));
       function_name();
     })
     $('#active_6').click(function() {
       $('#active_1').removeClass('active3');
       $('#active_2').removeClass('active3');
       $('#active_3').removeClass('active3');
       $('#active_4').removeClass('active3');
       $('#active_5').removeClass('active3');
       $('#active_6').addClass('active3');
       $('#cl_').val($('#active_6').attr('data-id'));
       $('#clearance_id').val($('#active_6').attr('data-id'));
       function_name();
     })
  
  function function_name() {
    if ($('#cl_').val() == "") {

        $('#cl_').val($('#active_1').attr('data-id'));
        $('#clearance_id').val($('#active_1').attr('data-id'));
      }
  
  
    // $.ajax({
      $.ajax({
          type     : "GET",
          cache    : false,
          url      :'/display/'+ $('#cl_').val(),
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
  
@endsection