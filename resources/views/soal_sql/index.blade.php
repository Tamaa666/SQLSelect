@extends('layouts.main')

@section('css')
  <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Soal SQL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Soal SQL</a></li>
              <li class="breadcrumb-item active">List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              	<div class="col-sm-6 pt-2">
              		<h3 class="card-title">List Data Soal SQL</h3>
              	</div>
              	<div class="col-sm-6" align="right">
              		<a href="{{url('soal_sql/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
              	</div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               @if($message=Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="alert-text">{{ucwords($message)}}</div>
                    </div>
               @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Soal</th>
                  <th>Jawaban</th>
                  <th>Table SQL</th>
                  <th>Bobot</th>
                  <th>Feedback Benar</th>
                  <th>Feedback Salah</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->soal}}</td>
                  <td>{{$item->jawaban}}</td>
                  <td>{{$item->nama_table}}</td>
                  <td>{{$item->bobot}}</td>
                  <td>{{$item->feedback_benar}}</td>
                  <td>{{$item->feedback_salah}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->updated_at}}</td>
                  <td>
                  	<a  href="{{url('soal_sql/edit/'.$item->id)}}" 
                  	    style="color: black;" 
                  	    class="fa fa-edit btn btn-warning btn-sm"> 
                  		Edit
                  	</a> 
                  	
                  </td>
                  <td>
                    <a  href="{{url('soal_sql/delete/'.$item->id)}}" 
                      style="color: black;" 
                        class="fa fa-edit btn-danger btn-sm"  
                        onclick="return confirm('Yakin menghapus data?')"> 
                      Hapus
                    </a>
                  </td>
                </tr>    
                @endforeach            
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script src="{{url('dist/js/pages/dashboard2.js')}}"></script>
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
	  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endsection