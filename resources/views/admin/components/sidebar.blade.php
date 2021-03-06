<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <?php
              if(Auth::user()->user_type == 1){
                $user_type = "Owner";
              }else if(Auth::user()->user_type == 2){
                $user_type = "Doctor";
              }else{
                $user_type = "Staff";
              }
          ?>
          <a href="#"><i class="fa fa-circle text-success"></i>{{$user_type}}</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="{{url('admin/owners')}}"><i class="fa fa-group "></i> <span>Pet Owners Information</span></a></li>
        <li><a href="{{url('admin/pets')}}"><i class="fa  fa-info-circle"></i> <span>Pet Information</span></a></li>
        <li><a href="{{url('admin/doctors')}}"><i class="fa fa-user-md"></i> <span>Doctors</span></a></li>
        <li><a href="{{url('admin/appointments')}}"><i class="fa fa-hand-o-up"></i> <span>Appointments</span></a></li>
        <li><a href="{{url('admin/medications')}}"><i class="fa fa-hospital-o"></i> <span>Medical History/Reports</span></a></li>
        <li><a href="{{url('admin/notifications')}}">
            <i class="fa fa-bell"></i>
            <span>Notifications</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">12</small>
            </span>
          </a></li>
        <li><a href="{{url('admin/services')}}"><i class="fa fa-book"></i> <span>Services</span></a></li>
        <li class="header">Settings</li>
        <li><a href="{{url('admin/accounts')}}"><i class="fa fa-user"></i> <span>Accounts</span></a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>