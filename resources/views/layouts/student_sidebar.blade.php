

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
            <a href="{{ route('Student-Dash') }}" class="nav-link clck dashboard" id="dashboard" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> View Clearance</p>
            </a>
          </li>

          <!-- Clearance -->
          <li class="nav-item has-treeview">
            <a href="{{ route('messenger') }}" id="message" class="nav-link clck"  > 
              <i class="nav-icon fas fa-copy"></i>
              <p> Message</p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="{{ route('clearance') }}" id="clearance" class="nav-link clck"  > 
              <i class="nav-icon fas fa-copy"></i>
              <p> Profile</p>
            </a>
          </li> -->
        </ul>
      </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
  </aside>