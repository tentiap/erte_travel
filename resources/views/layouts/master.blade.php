<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERTE TOUR AND TRAVEL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/adminlte/css/skins/_all-skins.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('Adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <!-- 
  <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
   
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
   
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="/adminlte/css/datetimepicker/bootstrap.min.css"> -->
  <link rel="stylesheet" href="/adminlte/css/datetimepicker/bootstrap-datetimepicker.min.css">

  

</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-car"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <i class="fa fa-car"> ERTE OKE! </i> 
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                inner menu: contains the actual data
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/adminlte/img/admin.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::guard('operator')->user()->nama }}</span>
              
            </a>
            <ul class="dropdown-menu" role="menu">
                <li class="user-footer">
                    
                      <a href="/logout" class="btn btn-default btn-flat, fa fa-sign-out" >Logout</a>
                    
                </li>
                
           </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          
        <li class="treeview">
          
          <a href="/kota">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="/users"><i class="fa fa-circle"></i> All-Users </a></li> -->
            <li><a href="/operator"><i class="fa fa-circle"></i> Operator </a></li>
            <li><a href="/sopir"><i class="fa fa-circle"></i> Sopir </a></li>
            <li><a href="/feeder"><i class="fa fa-circle"></i> Feeders</a></li>
            <li><a href="/pemesan"><i class="fa fa-circle"></i> Pemesan</a></li>
          </ul>
        </li>

        <li><a href="/pesanan"><i class="glyphicon glyphicon-th-list"></i> <span>Pesanan</span></a></li>
        <li><a href="/trip"><i class="fa  fa-pencil-square-o"></i> <span>Trip</span></a></li>
        <li><a href="/rute"><i class="fa  fa-pencil-square-o"></i> <span>Rute</span></a></li>
        <li><a href="/kota"><i class="fa  fa-pencil-square-o"></i> <span>Kota</span></a></li>
        <li><a href="/seat"><i class="fa  fa-pencil-square-o"></i> <span>Seat</span></a></li>
        <li><a href="/roles"><i class="fa  fa-pencil-square-o"></i> <span>Manage Roles</span></a></li>
        <li><a href="/permissions"><i class="fa  fa-pencil-square-o"></i> <span>Manage Permissions</span></a></li>
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    
      @yield('breadcrumb')

     
      <!-- <section class="content-header">
      <h1>
          Blank page
          <small>it all starts here</small>
      </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
      </section>
 -->
 

<!--     <div class="box-body">
      @include('messages')
    </div> -->

    
    @yield('content')

    <!-- <section class="content"> -->

      <!-- Default box -->
      <!-- <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Start creating your amazing application!
        </div> -->
        <!-- /.box-body -->
        <!-- <div class="box-footer">
          Footer
        </div> -->
        <!-- /.box-footer-->
      <!-- </div> -->
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer> -->

 
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

<script>
  $(function () {
    $('#sortdata').DataTable()
  })
</script>

<!-- DataTables -->
<script src="{{asset('Adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

  <!-- <script src="{{asset('Adminlte/js/datetimepicker/jquery.min.js')}}"></script> -->
  <script src="{{asset('Adminlte/js/datetimepicker/moment-with-locales.min.js')}}"></script>
  <!-- <script src="{{asset('Adminlte/js/datetimepicker/bootstrap.min.js')}}"></script> -->
  <script src="{{asset('Adminlte/js/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

  <script>
      $(function () {
        $('#datetime').datetimepicker({
          format:'YYYY-MM-DD HH:mm'
        })
      })
  </script>



@yield('cs')

</body>
</html>