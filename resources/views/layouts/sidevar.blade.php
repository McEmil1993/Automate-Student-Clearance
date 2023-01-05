

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color: #296694">
      <img src="{{ asset('uploads/tmc-logo.png') }} " alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: #fff"> Student Clearance</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item has-treeview">
            <a href="{{ route('home') }}" class="nav-link clck dashboard" id="dashboard" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard</p>
            </a>
          </li>


          <li class="nav-item has-treeview" id="cl_">
            <a href="{{ route('clearance') }}" id="clearance" class="nav-link clck"  > 
              <i class="nav-icon fas fa-copy"></i>
              <p> Clearance</p>
            </a>
          </li>
          <!-- Designee -->
          <li class="nav-item has-treeview">
            <a href="{{ route('assignee') }}" id="assignee" class="nav-link clck">
              <i class="nav-icon fa fa-fw fa-user"></i>
              <p> Assignee</p>
            </a>
          </li>
          <!-- Students -->
          <li class="nav-item has-treeview">
            <a  href="{{ route('student') }}" class="nav-link clck" id="students" >
              <i class="nav-icon fa fa-fw fa-users"></i>
              <p> Students</p>
            </a>
          </li>
          <!-- Manage Others -->
          <li class="nav-item has-treeview" id="manage">
            <a href="#" id="manage_others" class="nav-link">
              <i class="nav-icon fa fa-fw fa-cog"></i>
              <p>
                Manage Others
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('Position')}}" id="position" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Position</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('department') }}" class="nav-link clck" id="department" >
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('course') }}" id="course" class="nav-link clck">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('Year Level') }}" id="year_lvl" class="nav-link clck">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Year Level</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('School Year') }}" id="school_year" class="nav-link clck">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>School Year</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('Prefix Suffix') }}" id="pfix_sfix" class="nav-link clck">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Prefix/Suffix</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('Signatory-Assign') }}" id="signatory_assign" class="nav-link clck">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Signatory Assign</p>
                </a>
              </li>
            </ul>
          </li>
  
          <!-- Access Rights -->
          <li class="nav-item has-treeview">
            <a href="{{ route('Manage-Access')}}" id="access_right" id="accessmanage" class="nav-link clck">
              <i class="nav-icon fa fa-fw fa-user-secret"></i>
              <p> Access Rights</p>
            </a>
          </li>
          <!-- User Profile -->
           <li class="nav-item has-treeview">
            <a href="{{ route('My Profile') }}" id="my_profile" class="nav-link clck">
              <i class="nav-icon fa fa-fw fa-user-circle"></i>
              <p> My Profile</p>
            </a>
          </li>
        </ul>
      </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
  </aside>