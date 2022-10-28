
@extends('layouts.student_main')

@section('content')
<style type="text/css">
  body{
    padding: 0px 0px 0px 0px !important;
  }
</style>
<div class="content-wrapper">
<!-- <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
</div> -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Clearance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">View Clearance</li>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="card">
        <div class="card-header">
          <h2 class="card-title"><strong>Clearance Status - </strong>  
            @php $ui = App\Http\Controllers\ClearanceController::getUserByID(Auth::user()->id);  @endphp
                      <?php 
                  
                          if(count($ui) == 6) { 
                            ?>
                             <span class="nt"><strong class="badge badge-success "> Cleared</strong></span>
                            <?php
                          }else{
                             ?>
                              <span class="nt"><strong class="badge badge-danger "> Not Cleared</strong></span>
                            
                            <?php
                          }

                        ?> &nbsp;&nbsp;&nbsp;<strong><a href="#" id="print_btn" style="color:black;"><i class="nav-icon fas fa-print"></i> Print</a></strong></h2>

          <div class="card-tools">

            <h3 class="card-title" style="margin-right: 20px;">School Year : <span style="color:green;">{{Session::get('school_year')}}</span> | {{Session::get('semester')}} Semester</h3>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
                @foreach($sig as $s)
                  <tr>
                      <td>
                          <h2 class="card-title">{{$s->name}}</h2>
                      </td>
                      @php $ui = App\Http\Controllers\StudentDashController::getAssByID(Auth::user()->id,$s->id);  @endphp

                      @php $ge = App\Http\Controllers\StudentDashController::getAss($s->id);  @endphp
                      <td class="project-actions text-right">
                        @if(!empty($ge)) 
                          <div class="text-center">
                           <img alt="A" class="table-avatar" style="border: 1px solid #7c7c7d;" src="{{asset($ge->H)}}">
                          </div>
                          <p class="text-muted text-center tcourse"> {{$ge->fullname}} </p>

                        @endif
                        

                      </td>
                      <td  class="text-right">
                        @if(!empty($ui)) 
                        <p class="text-muted text-center tcourse">  <span style='font-size:30px;'>&#10004;</span> </p>
                        @endif
                      </td>
                  </tr>
                @endforeach
           
          </table>
        </div>
        <!-- /.card-body -->
      </div>

      <div class="modal fade" id="modal-ol">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <div class="modal-body">
              <div id="div_to_print" style="height:799px;width: 743px;">
             
              <div style="padding:0px 20px 0px 20px;">
                <div style="width: 100%;"><div style="width: 20%;float: left;">
                    <img style="width: 110px;height: 110px;border-radius: 75px 75px ;margin:0px 0px 10px 10px" src="/uploads/tmc-logo.png"> 
                </div>  
                    <center> 
                        <h1 style="margin: 0px;font-family:serif;">TRINIDAD MUNICIPAL COLLEGE</h1>
                        <h3 style="margin: 8px 0px 0px 0px;font-family:serif;">OFFICE of the REGISTRAR</h3>
                        <h1 style="margin: 8px 0px 0px 0px;font-family:serif;"><u>STUDENT`S CLEARANCE FORM</u></h1>
                    </center>
                </div> 
            </div>
            @php $get_info = App\Http\Controllers\StudentDashController::get_info();  @endphp
            <table border="1" cellspacing="0" style="margin: 5px 5px 0px 5px;width: 100%">
                <tbody>
                    <tr> 
                        <td width="25%">ID NUMBER</td>
                        <td align="center" width="25%"><strong>{{$get_info->st}}</strong></td> 
                        <td align="center" align="center" width="25%">CONTROL NUMBER</td>
                        <td align="center" width="25%"><strong>{{$get_info->control_number}}</strong></td>
                    </tr>
                    <tr>
                        <td width="25%" valign="Top" align="Left" rowspan="2">NAME OF STUDENT</td>
                        <td align="center" width="25%"><strong>{{$get_info->lastname}}</strong></td>
                        <td align="center" width="25%"><strong>{{$get_info->firstname}}</strong></td>
                        <td align="center" width="25%"><strong>{{$get_info->middlename}}</strong></td>
                    </tr>
                    <tr>
                        <td align="center" width="25%">(FAMILY NAME)</td>
                        <td align="center" width="25%">(GIVEN NAME)</td>
                        <td align="center" width="25%">(MIDDLE NAME)</td>
                    </tr>
                    <tr> 
                        <td width="25%">SCHOOL YEAR</td>
                        <td align="center" width="25%"><strong>{{Session::get('school_year')}}</strong></td>
                        <td align="center" width="25%">SEMESTER</td>
                        <td align="center" width="25%">
                            <input type="checkbox" <?php echo(Session::get('semester') == '1st')? 'checked': ''; ?> name="">1st
                            <input type="checkbox" <?php echo(Session::get('semester') == '2nd')? 'checked': ''; ?> name="">2nd
                            <input type="checkbox" <?php echo(Session::get('semester') == 'summer')? 'checked': ''; ?> name="">Summer
                        </td>
                    </tr> 
                    <tr>
                        <td width="25%">COURSE</td> 
                        <td colspan="3" width="75%"><strong>{{$get_info->description}}</strong></td>
                    </tr>
                </tbody>
            </table>
            <p style="margin: 0px">&emsp;&emsp;&emsp;&emsp;THIS IS TO CERTIFY that the aboved-named student has no money, property, documents and other accountabilities in his class, department and in the school in general.</p> 

            
            <table border="1" cellspacing="0" style="margin: 0px 5px 5px 5px;width: 100%">
                <tbody>
                    <tr>
                        <td width="25%">DATE FILED</td>
                        <td width="25%"></td>
                        <td width="25%">PTA TRESURER</td>
                        <td width="25%">
                          @php $pta = App\Http\Controllers\StudentDashController::getAssBySig(Auth::user()->id,6);  @endphp
                          @if(!empty($pta)) 
                          <p style="font-size:10px">{{$pta->fullname}}</p><img style="position: absolute;height: 100px;width: 100px;top: 246px; left: 670px; z-index: 99; " src="{{asset($pta->sp)}}">
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">SCHOOL CASHER</td> 
                        <td width="25%"> 
                          @php $c = App\Http\Controllers\StudentDashController::getAssBySig(Auth::user()->id,4);  @endphp
                          @if(!empty($c)) 
                          <p style="font-size:10px">{{$c->fullname}}</p><img style="position: absolute;height: 100px;width: 100px;top: 272px; left: 300px; z-index: 99; "src="{{asset($c->sp)}}">
                          @endif</td>
                        <td width="25%">SCHOOL REGISTRAR</td>
                        <td width="25%">
                          @php $re = App\Http\Controllers\StudentDashController::getAssBySig(Auth::user()->id,2);  @endphp
                          @if(!empty($re)) 
                          <p style="font-size:10px">{{$re->fullname}}</p><img style="position: absolute;height: 100px;width: 100px;top: 265px; left: 670px; z-index: 99; " src="{{asset($re->sp)}}">
                          @endif</td>
                    </tr>
                    <tr>
                        <td width="25%">DEPARTMENT HEAD</td> 
                        <td align="" width="25%">
                          @php $dh = App\Http\Controllers\StudentDashController::getAssBySig(Auth::user()->id,3);  @endphp
                          @if(!empty($dh)) 
                          <p style="font-size:10px">{{$dh->fullname}}</p><img style="position: absolute;height: 100px;width: 100px;top: 288px; left: 300px; z-index: 99; "src="{{asset($dh->sp)}}">
                          @endif
                        </td> 
                        <td align="center" width="25%">&nbsp;&nbsp;</td>
                        <td align="center" width="25%">&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="25%">SSG ADVISER</td>
                        <td align="" width="25%">
                          @php $ssg = App\Http\Controllers\StudentDashController::getAssBySig(Auth::user()->id,5);  @endphp
                          @if(!empty($ssg)) 
                          <p style="font-size:10px">{{$ssg->fullname}}</p><img style="position: absolute;height: 100px;width: 100px;top: 300px; left: 300px; z-index: 99; "src="{{asset($ssg->sp)}}">
                          @endif
                        </td>
                        <td align="center" width="25%">&nbsp;&nbsp;</td>
                        <td align="center" width="25%">&nbsp;&nbsp;</td>
                    </tr> 
                </tbody>
            </table>
            <br>
            <br>
                <center>
                   @php $a = App\Http\Controllers\StudentDashController::getAss(1)  @endphp
                  @php $ad = App\Http\Controllers\StudentDashController::getAssBySig(Auth::user()->id,1);  @endphp
                    @if(!empty($ad)) 
                    <img style="position: absolute;height: 100px;width: 100px;top: 350px; left: 345px; z-index: 99; " src="{{asset($ad->sp)}}">
                   
                   
                    @endif 
                    @if(!empty($a)) 
                    <h4 style="margin: 0px"><u>{{$a->fullname}}</u></h4>
                    @endif</td>
                    
                    <p style="margin: 0px">School Administrator</p>
                </center>
                <p>This clearance must be signed by all concerned officers and the same must be submitted to issuing officer in excharge for an ADMISSION NUMBER. No Admission means No Final Examination.</p>
                <hr>
            </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

     
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script type="text/javascript">
  $(document).ready(function(e) {
     $('a#print_btn').on('click', function(e)  {
          $('#div_to_print').printThis();
     }); 
  });
</script>
  <script>
      // start_load();
      $('#dashboard').addClass('active3');
     
  </script>
  @endsection

