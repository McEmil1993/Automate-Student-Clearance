    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #296694" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" style="color: #fff;" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
      <div class="user-panel mt-0 pb-1 mb-0 d-flex">
        <div class="image">
        @if (auth()->user()->image)      
          <img src="{{ asset(auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        @endif
        </div>
        <div class="info" style="color: #fff;" >
          {{ Auth::user()->name }} 
        </div>
      </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        </form>
      </li>
     
    </ul>
  </nav>