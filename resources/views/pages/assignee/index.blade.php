
@extends('layouts.header')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6 col-8 mb-2">
            <h5 class="m-0 text-dark"><strong> TMC - Clearance/Manage Others/Assignee</strong></h5>
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
            <button type="button" data-toggle="modal" data-target="#modal-add" class="btn btn-default btn-info btn-sm" style="background-color:#138496;color: white;">New Assignee</button>
            <table id="example2" class="table table-striped projects" >
              <thead>
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <th>
                        <h5><strong>List of Assignee</strong></h5>
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
                @foreach($assignee as $assignees)

                @if($assignees->uid != Auth::user()->id )
                <tr>
                  <div class="row">
                    <div class="col-lg-8">
                      <td>
                        <div class="user-panel  d-flex">
                            <div class="image mt-2">
                                <img src="{{asset($assignees->pr)}}" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info" >
                                <strong> {{$assignees->fullname}}</strong> - {{$assignees->pos}}<br>
                                <small>{{$assignees->no}} - {{$assignees->addrss}}</small>
                            </div>
                        </div>
                      </td>
                    </div>
                    <div class="col-lg-2">
                      <td>
                        <div class="time-label">
                          <?php echo ($assignees->st == "1")? '<strong style="color:#28a745;">Active</strong>' : '<strong  style="color:#dc3545;">Unactive</strong>'; ?>
                        </div>
                      </td>
                    </div>
                    <div class="col-lg-2">
                      <td class="project-actions">
                        <a class="" href="#" data-toggle="dropdown"><img src="{{ asset('svg-loaders/three-dots.svg')}}" width="40" alt=""></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit" href="#" data-id="{{$assignees->uid}}" data-toggle="modal" data-target="#modal-update" >Update Info</a>
                            <a class="dropdown-item u_st" href="#" data-id="{{$assignees->uid}}" data-name="{{$assignees->fullname}}" data-status="{{$assignees->st}}" data-toggle="modal" data-target="#modal-status" >Update status</a>
                            <a class="dropdown-item delete" data-toggle="modal" data-target="#modal-delete" data-id="{{$assignees->uid}}" data-position="{{$assignees->fullname}}" href="#">Delete</a>
                          </div>
                      </td>
                    </div>
                  </div>
                </tr>

                

                @endif
                
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
          <h4 class="modal-title ">New Assignee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('assignee add') }}" method="POST" role="form" enctype="multipart/form-data">
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
                  <div class="row">
                    <div class="col-lg-6 col-6 " >
                      <div class="form-group">
                        <div class="select2-primary">
                           <?php  

                          $prefix2 = (array)old('prefix');
                        
                          ?>
                          <select class="select2 prefix @error('prefix') is-invalid @enderror"  value="<?php echo json_encode(old('prefix'))?>" name="prefix[]" multiple="multiple" data-placeholder="Prefix" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            <!-- <option selected disabled>Prefix</option> -->
                            @if(old('prefix')!="")
                            {{$i = 0}}
                            @foreach($prefix as $prefixs)
                          
                              <option <?php echo(in_array($prefixs->prefix, $prefix2, TRUE))? 'selected' :''; ?> value="{{$prefixs->prefix}}">{{$prefixs->prefix}}</option>
                             
                            
                            {{$i+=1}}
                              
                             @endforeach
                             @else

                             @foreach($prefix as $prefixs)
                             <option  value="{{$prefixs->prefix}}">{{$prefixs->prefix}}</option>
                             @endforeach
                             @endif


                          </select>
                          @error('prefix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-6 " >
                       <div class="form-group">
                        <div class="select2-primary">
                          <?php  


                          
                            // code... 
                            $suffix2 = old('suffix');


                         // $os = array(old('suffix'));

                          $re1 = str_replace('[','',$suffix2);
                          $re2 = str_replace(']','',$re1);
                          $re3 = array($re2);
                          
                          // $result = json_decode($suffix2, true);
                          // $result = array_values($result)[1];
                          // $result = array_values($result)[0];
                          ?>
                          <select class="select2 @error('suffix') is-invalid @enderror" name="suffix[]"  multiple="multiple" data-placeholder="Suffix" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            @if(old('suffix') !="" )
                            {{$i = 0}}
                                @foreach($suffix as $suffixs)
                              
                                  <option <?php echo(in_array($suffixs->suffix, $suffix2, TRUE))? 'selected' :''; ?> value="{{$suffixs->suffix}}">{{$suffixs->suffix}}</option>
                                 
                                {{$i++}}
                                  
                                 @endforeach

                             @else

                                 @foreach($suffix as $suffixs)
                                 <option  value="{{$suffixs->suffix}}">{{ $suffixs->suffix }}</option>
                                 @endforeach
                             @endif
                          </select>
                      

                          @error('suffix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                      </div>
                    </div>
                  </div>
              
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('department') is-invalid @enderror"  value="{{ old('department') }}" name="department"  >
                      <option value="" selected="" disabled="">Department</option>
                      @foreach($department as $departments)
                      @if(old('department') == $departments->id)
                          <option <?php echo 'selected' ?> value="{{$departments->id}}">{{$departments->department}}</option>
                       @else
                          <option  value="{{$departments->id}}">{{$departments->department}}</option>
                       @endif
                      @endforeach
                    </select>
                    @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('position') is-invalid @enderror"   name="position" >
                      <option value="" selected="" disabled="">Position</option>
                       @foreach($position as $positions)
                       @if(old('position') == $positions->id)
                          <option <?php  echo 'selected' ?> value="{{$positions->id}}">{{$positions->position}}</option>
                       @else
                          <option  value="{{$positions->id}}">{{$positions->position}}</option>
                       @endif
                      
                      @endforeach
                    </select>
                    @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}" name="role" >
                      <option  value="" selected="" disabled="">Role</option>
                      @if(old('role') == "1")
                        <option <?php echo 'selected' ?> value="1">Admin</option>
                        <option value="2">User</option>
                       @elseif(old('role') == "2")
                        <option value="1">Admin</option>
                        <option <?php echo 'selected' ?> value="2">User</option>

                       @else
                        <option value="1">Admin</option>
                        <option value="2">User</option>

                       @endif
                      
                    </select>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('signature_assign') is-invalid @enderror"  value="{{ old('signature_assign') }}" name="signature_assign" >
                      <option  value="" selected="" disabled="">Signatory Assign</option>
                       @foreach($sig as $sigs)
                       @if(old('sig') == $sigs->id)
                          <option <?php  echo 'selected' ?> value="{{$sigs->id}}">{{$sigs->name}}</option>
                       @else
                          <option  value="{{$sigs->id}}">{{$sigs->name}}</option>
                       @endif
                      
                      @endforeach

                      
                    </select>
                    @error('signature_assign')
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
                          <input type="hidden" name="u_sig" class="u_sig" value="{{ old('u_sig') }}"> 
                          <input type="file" name="sig_img" id="sigImg" value="{{ old('u_sig') }}" class="custom-file-input sigImg">
                          <label class="custom-file-label sig" for="customFile">Signature Image {{ old('sig_img') }}</label>
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
          <h4 class="modal-title ">Update Assignee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('assignee_update') }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
          <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="hidden" name="id" id="id_">

                    <input type="text" name="firstname" id="firstname"  value="{{ old('firstname') }}" class="form-control  @error('firstname') is-invalid @enderror"  placeholder="Firstname" >
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="middlename" id="middlename" value="{{ old('middlename') }}" class="form-control @error('middlename') is-invalid @enderror" placeholder="Middlename" >
                    @error('middlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                 </div>

                 <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" class="form-control @error('lastname') is-invalid @enderror" placeholder="Lastname" >
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6 col-6 " >
                      <div class="form-group">
                        <div class="select2-primary">
                           <?php  

                          $prefix2 = (array)old('prefix');
                        
                          ?>
                          <select class="select2 prefix @error('prefix') is-invalid @enderror" id="prefix" value="<?php echo json_encode(old('prefix'))?>" name="prefix[]" multiple="multiple" data-placeholder="Prefix" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            <!-- <option selected disabled>Prefix</option> -->
                            @if(old('prefix')!="")
                            {{$i = 0}}
                            @foreach($prefix as $prefixs)
                          
                              <option <?php echo(in_array($prefixs->prefix, $prefix2, TRUE))? 'selected' :''; ?> value="{{$prefixs->prefix}}">{{$prefixs->prefix}}</option>
                             
                            
                            {{$i+=1}}
                              
                             @endforeach
                             @else

                             @foreach($prefix as $prefixs)
                             <option  value="{{$prefixs->prefix}}">{{$prefixs->prefix}}</option>
                             @endforeach
                             @endif

                          </select>
                          @error('prefix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-6 " >
                       <div class="form-group">
                        <div class="select2-primary">
                          <?php  
                            $suffix2 = old('suffix');
                          $re1 = str_replace('[','',$suffix2);
                          $re2 = str_replace(']','',$re1);
                          $re3 = array($re2);
                          ?>
                          <select class="select2 @error('suffix') is-invalid @enderror" onchange="" name="suffix[]" id="suffix" multiple="multiple" data-placeholder="Suffix" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            @if(old('suffix') !="" )
                            {{$i = 0}}
                                @foreach($suffix as $suffixs)
                              
                                  <option <?php echo(in_array($suffixs->suffix, $suffix2, TRUE))? 'selected' :''; ?> value="{{$suffixs->suffix}}">{{$suffixs->suffix}}</option>
                                 
                                {{$i++}}
                                  
                                 @endforeach

                             @else

                                 @foreach($suffix as $suffixs)
                                 <option  value="{{$suffixs->suffix}}">{{ $suffixs->suffix }}</option>
                                 @endforeach
                             @endif
                          </select>
                      

                          @error('suffix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                      </div>
                    </div>
                  </div>
              
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('department') is-invalid @enderror" id="department1" value="{{ old('department') }}" name="department"  >
                      <option value="" selected="" disabled="">Department</option>
                      @foreach($department as $departments)
                      @if(old('department') == $departments->id)
                          <option <?php echo 'selected' ?> value="{{$departments->id}}">{{$departments->department}}</option>
                       @else
                          <option  value="{{$departments->id}}">{{$departments->department}}</option>
                       @endif
                      @endforeach
                    </select>
                    @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('position') is-invalid @enderror" id="position1"  name="position" >
                      <option value="" selected="" disabled="">Position</option>
                       @foreach($position as $positions)
                       @if(old('position') == $positions->id)
                          <option <?php  echo 'selected' ?> value="{{$positions->id}}">{{$positions->position}}</option>
                       @else
                          <option  value="{{$positions->id}}">{{$positions->position}}</option>
                       @endif
                      
                      @endforeach
                    </select>
                    @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('role') is-invalid @enderror" id="role" value="{{ old('role') }}" name="role" >
                      <option  value="" selected="" disabled="">Role</option>
                      @if(old('role') == "1")
                        <option <?php echo 'selected' ?> value="1">Admin</option>
                        <option value="2">User</option>
                       @elseif(old('role') == "2")
                        <option value="1">Admin</option>
                        <option <?php echo 'selected' ?> value="2">User</option>

                       @else
                        <option value="1">Admin</option>
                        <option value="2">User</option>

                       @endif
                      
                    </select>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <select class="form-control @error('signature_assign') is-invalid @enderror" id="signature_assign"  value="{{ old('signature_assign') }}" name="signature_assign" >
                      <option  value="" selected="" disabled="">Signatory Assign</option>
                       @foreach($sig as $sigs)
                       @if(old('sig') == $sigs->id)
                          <option <?php  echo 'selected' ?> value="{{$sigs->id}}">{{$sigs->name}}</option>
                       @else
                          <option  value="{{$sigs->id}}">{{$sigs->name}}</option>
                       @endif
                      
                      @endforeach

                      
                    </select>
                    @error('signature_assign')
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
                        <input type="number" name="contact"  value="{{ old('contact') }}" id="contact" class="form-control  @error('contact') is-invalid @enderror" placeholder="Contact Ex.(+63912345678)" >
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
                          <input type="hidden" name="u_sig" class="u_sig" value="{{ old('u_sig') }}"> 
                          <input type="file" name="sig_img" id="sigImg" value="{{ old('u_sig') }}" class="custom-file-input sigImg">
                          <label class="custom-file-label sig" for="customFile">Signature Image {{ old('sig_img') }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="3" name="address" placeholder="Address" style="height: 93px;">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email')  is-invalid @enderror" id="email" value="{{ old('email') }}"placeholder="Email">
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
                    <input type="password" name="password" placeholder="Password"  value="{{ old('password') }}"  class="form-control @error('password') is-invalid @enderror">
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
<!-- moddal end -->

  <!-- modal update -->
  <div class="modal fade" id="" data-backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Update Position</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          @csrf
        <div class="modal-body">
          <div class="form-group">
              <div class="select2-primary">
                
                <select class="select2 @error('suffix') is-invalid @enderror" name="suffix[]" id="ol" multiple="multiple" data-placeholder="Suffix" data-dropdown-css-class="select2-primary" style="width: 100%;">
                 
                  {{$i = 0}}
                   @foreach($suffix as $suffixs)
                   <option class="op<?php echo $i ?>" value="{{$suffixs->suffix}}">{{ $suffixs->suffix }}</option>
                   {{$i++}}
                   @endforeach
                  
                </select>
            

                @error('suffix')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
              </div>
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

   <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title">Delete Assignee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('assignee_delete')}}" method="POST">
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


  <div class="modal fade" id="modal-status">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:none">
          <h4 class="modal-title tl" >Update Status</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('assignee_status')}}" method="POST">
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
  <!--modal End -->
  <script type="text/javascript">
  $(document).ready(function(){
      $('.bootstrap-select').selectpicker();
      
      $('#framework').change(function(){
        $('#hidden_suffix').val($('#framework').val());
      });
      //GET UPDATE
      // $('.update-record').on('click',function(){
      //   var package_id = $(this).data('package_id');
      //   var package_name = $(this).data('package_name');
      //   $(".strings").val('');
      //   $('#UpdateModal').modal('show');
      //   $('[name="edit_id"]').val(package_id);
      //   $('[name="package_edit"]').val(package_name);
      //           //AJAX REQUEST TO GET SELECTED PRODUCT
                // $.ajax({
                //     url: "",
                //     method: "POST",
                //     data :{package_id:package_id},
                //     cache:false,
                //     success : function(data){
                //         var item=data;
                //         var val1=item.replace("[","");
                //         var val2=val1.replace("]","");
                //         var values=val2;
                //         $.each(values.split(","), function(i,e){
                //             $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                //             $(".strings").selectpicker('refresh');

                //         });
                //     }
                    
                // });
      //           return false;
      // });

      //GET CONFIRM DELETE
      // $('.delete-record').on('click',function(){
      //   var package_id = $(this).data('package_id');
      //   $('#DeleteModal').modal('show');
      //   $('[name="delete_id"]').val(package_id);
      // });

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
  // $('.prefix').val("1");
  
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

  $('.edit').click(function (){
    var id = $(this).attr('data-id');
    $.ajax({
        url: "/get_assignee/"+id,
        method: "GET",
        data :{id:id},
        cache:false,
        dataType:'json' ,
        success : function(data){

          var prefix = data.prefix;
          var suffix = data.suffix;
          $('#id_').val(id);
          $('#firstname').val(data.firstname);
          $('#lastname').val(data.lastname);
          $('#middlename').val(data.middlename);

          $.each(prefix.split(","), function(i,e){
              $("#prefix option[value='" + e + "']").prop("selected", true).trigger('change');
          });
          $.each(suffix.split(","), function(i,e){
              $("#suffix option[value='" + e + "']").prop("selected", true).trigger('change');
          });
          $("#department1 option[value='" + data.department + "']").prop("selected", true).trigger('change');
          
          $("#position1 option[value='" + data.position + "']").prop("selected", true).trigger('change');
          $("#role option[value='" + data.role + "']").prop("selected", true).trigger('change');
          $("#signature_assign option[value='" + data.signature_assign + "']").prop("selected", true).trigger('change');
          $('#contact').val(data.contact);
          $('#address').html(data.address);
          $('#email').val(data.email);
          
          // $('#department').val(data.department);
          // $('#position').val(data.position);


        }
        
    });

   

    // $.each(position.split(","), function(i,e){
    //     $("#ol option[value='" + e + "']").prop("selected", true).trigger('change');

    // });


    // $('#ol').val(array);
 

  });

  $('.delete').click(function (){
    var id = $(this).attr('data-id');
    var position = $(this).attr('data-position');
    // var status = $('.edit').attr('data-status');

    $('#d_id').val(id);
    $('#d_name').html(position);
    // $('.e_status').val(status);

  });
 $('.sigImg').on('change',function() {
  // C:\fakepath\exmedicine.jpg
   var v = $(this).val();
   var itemId = v.substring(12);
       
   $('.sig').html(itemId);
   $('.u_sig').val(v);
 })

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
  $('#assignee').addClass('active3');
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

