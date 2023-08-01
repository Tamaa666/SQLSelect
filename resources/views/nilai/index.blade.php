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
            <h1>Nilai Simulasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Nilai Simulasi</a></li>
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
                  <h3 class="card-title">Daftar Nilai Simulasi</h3>
                </div>
                <div class="col-sm-6 pt-2" align="right">
                 <a href="{{url('nilai_export')}}" class="btn btn-success">Export</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Mahasiswa</th>
                  <th>Simulasi</th>
                  <th>Type</th>  
                  <th>Soal</th>
                  <th>Kelas</th>
                  <th>Nilai</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->nama_mahasiswa}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->type}}</td>
                  <td>{{$item->nama_paket}} - ({{$paket[$item->id]}} Soal)</td>
                  <td>{{$item->nama_kelas}}</td>
                  <td>
                    @if(strtotime($item->end_date_time) >= $now)
                      @if($nilai[$item->id] > 0)
                        @if($percobaan[$item->id] > 1)
                          <ul>
                            @foreach($nilai[$item->id] as $nilaiKey => $itemNilai)
                              <li>
                                Nilai Percobaan Ke - {{$nilaiKey}} : {{$itemNilai}} <br> 
                                <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/'.$nilaiKey.'/'.$item->mahasiswa_id)}}"> Review</a>
                              </li>
                            @endforeach
                          </ul>
                        @else
                          Nilai : {{$nilai[$item->id]}} 
                                  <br>
                                  <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/0'.'/'.$item->mahasiswa_id)}}">Review</a>
                        @endif
                      @else
                        Nilai : - 
                      @endif
                    @else
                     @if($nilai[$item->id] > 0)
                        @if($percobaan[$item->id] > 1)
                          <ul>
                            @foreach($nilai[$item->id] as $nilaiKey => $itemNilai)
                              <li>
                                Nilai Percobaan Ke - {{$nilaiKey}} : {{$itemNilai}} <br>
                                <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/'.$nilaiKey.'/'.$item->mahasiswa_id)}}">Review</a>
                              </li>
                            @endforeach
                          </ul>
                        @else
                          Nilai : {{$nilai[$item->id]}}  
                                  <br>
                                  <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/0'.'/'.$item->mahasiswa_id)}}">Review</a>
                        @endif
                      @else
                        Nilai : -
                      @endif
                    @endif
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