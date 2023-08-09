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
            <h1>Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
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
              		<h3 class="card-title">List Data Mahasiswa</h3>
              	</div>
              	<div class="col-sm-6" align="right">
              		<a href="{{url('mahasiswa/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                  &nbsp;
                  <a class="btn btn-info" style="cursor: pointer;" data-toggle="modal" data-target="#import">
                    <i class="fa fa-file-excel-o"></i> Import Data</a>
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
                  <th>Nim</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->nim}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->nama_kelas}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->updated_at}}</td>
                  <td>
                  	<a  href="{{url('mahasiswa/edit/'.$item->id)}}" 
                  	    style="color: black;" 
                  	    class="fa fa-edit btn btn-warning btn-sm"> 
                  		Edit
                  	</a> &nbsp;
                  	<a  href="{{url('mahasiswa/delete/'.$item->id)}}" 
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

  <!-- The Modal -->
<div class="modal" id="import">
  <div class="modal-dialog modal-xl">
    <form action="{{url('mahasiswa/import')}}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Import Data Mahasiswa</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>
          Untuk melihat format isi yang dapat di import / template bisa download 
          <a href="{{url('asset_application/import/template.xlsx')}}" download>disini</a>
        </p>
         <div class="form-group">
            <label>Upload File Import</label>
            <input type="file" name="file" required class="form-control">
         </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button class="btn btn-success" type="submit">Import</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </form>
  </div>
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