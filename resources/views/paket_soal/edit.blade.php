@extends('layouts.main')

@section('css')

@endsection
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Paket Soal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Paket Soal</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Data Paket Soal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('paket_soal/update/'.$data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if($message=Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-text">{{ucwords($message)}}</div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Paket Soal</label>
                        <input type="text" name="nama" required class="form-control" placeholder="Contoh : Paket Lathian Semester 1 2023" value="{{$data->nama}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-12" align="center">
                      <p align="center">
                        Pilih Soal - Silahkan Checklist Soal-soal yang ingin di masukkan 
                      </p>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Soal</th>
                          <th>Jawaban</th>
                          <th>Table SQL</th>
                          <th>Bobot</th>
                          <th>Feedback Benar</th>
                          <th>Feedback Salah</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($soal as $key => $item)
                        <tr>
                          <td>
                            <div class="form-check">
                              @if(in_array($item->id,$soalSelected))
                                <input type="checkbox" name="soal_id[]" checked value="{{$item->id}}" class="form-check-input" id="exampleCheck1{{$item->id}}">
                              @else
                                 <input type="checkbox" name="soal_id[]" value="{{$item->id}}" class="form-check-input" id="exampleCheck1{{$item->id}}">
                              @endif
                              <label class="form-check-label" for="exampleCheck1{{$item->id}}"></label>
                            </div>
                          </td>
                          <td>{{$item->soal}}</td>
                          <td>{{$item->jawaban}}</td>
                          <td>{{$item->nama_table}}</td>
                          <td>{{$item->bobot}}</td>
                          <td>{{$item->feedback_benar}}</td>
                          <td>{{$item->feedback_salah}}</td>
                          <td>{{$item->created_at}}</td>
                          <td>{{$item->updated_at}}</td>
                        </tr>    
                        @endforeach            
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="right">
                  <button type="reset" class="btn btn-default">Reset</button>
                  &nbsp;&nbsp;
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
<script src="{{url('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
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