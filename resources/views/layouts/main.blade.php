<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SSQILOP | Dashboard </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
  @yield('css')
  <link rel="shortcut icon" href="{{url('dist/img/sql.png')}}" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <div class="col-md-12">
     <p class="pt-2" align="center">
      Selamat Datang {{Auth::user()->name}} Di Select SQL iCLOP | SSQILOP |
      Anda Login Sebagai {{ucwords(Auth::user()->role)}} | 
      <a class="fa fa-sign-out" style="cursor: pointer;color: black;" 
         href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Keluar Sistem
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </p>
   </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{url('dist/img/sql.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SSQILOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Menu</li>
          <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link {{Request::segment(1) == 'home'?'active':''}}">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if(Auth::user()->role == 'dosen')
          <li class="nav-item">
            <a href="{{url('mahasiswa')}}" class="nav-link {{Request::segment(1) == 'mahasiswa'?'active':''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>Mahasiswa</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('kelas')}}" class="nav-link {{Request::segment(1) == 'kelas'?'active':''}}">
              <i class="nav-icon fa fa-address-card-o"></i>
              <p>Kelas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('materi')}}" class="nav-link {{Request::segment(1) == 'materi'?'active':''}}">
              <i class="nav-icon fa fa-file-pdf-o"></i>
              <p>Materi</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('data_table')}}" class="nav-link {{Request::segment(1) == 'data_table'?'active':''}}">
              <i class="nav-icon fa fa-list-alt"></i>
              <p>Tabel SQL</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('soal_sql')}}" class="nav-link {{Request::segment(1) == 'soal_sql'?'active':''}}">
              <i class="nav-icon fa fa-file-code-o"></i>
              <p>Soal SQL</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('paket_soal')}}" class="nav-link {{Request::segment(1) == 'paket_soal'?'active':''}}">
              <i class="nav-icon fa fa-file"></i>
              <p>Paket Soal</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('simulasi_latihan')}}" class="nav-link {{Request::segment(1) == 'simulasi_latihan'?'active':''}}">
              <i class="nav-icon fa fa-calendar-o"></i>
              <p>Simulasi Latihan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('simulasi_ujian')}}" class="nav-link {{Request::segment(1) == 'simulasi_ujian'?'active':''}}">
              <i class="nav-icon fa fa-calendar-check-o"></i>
              <p>Ujian</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('nilai_simulasi')}}" class="nav-link {{Request::segment(1) == 'nilai_simulasi'?'active':''}}">
              <i class="nav-icon fa fa-bar-chart"></i>
              <p>Nilai Simulasi</p>
            </a>
          </li>
          @endif

          @if(Auth::user()->role == 'mahasiswa')
          <li class="nav-item">
            <a href="{{url('materi_mahasiswa')}}" class="nav-link {{Request::segment(1) == 'materi_mahasiswa'?'active':''}}">
              <i class="nav-icon fa fa-file-pdf-o"></i>
              <p>Materi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('simulasi_latihan_mahasiswa')}}" class="nav-link {{Request::segment(1) == 'simulasi_latihan_mahasiswa'?'active':''}}">
              <i class="nav-icon fa fa-calendar-o"></i>
              <p>Simulasi Latihan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('simulasi_ujian_mahasiswa')}}" class="nav-link {{Request::segment(1) == 'simulasi_ujian_mahasiswa'?'active':''}}">
              <i class="nav-icon fa fa-calendar-check-o"></i>
              <p>Ujian</p>
            </a>
          </li>

          
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright © {{date('Y')}} | Arjuna Pratama</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.0.1
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{url('dist/js/demo.js')}}"></script>


@yield('script')
<!-- PAGE SCRIPTS -->


</body>
</html>
