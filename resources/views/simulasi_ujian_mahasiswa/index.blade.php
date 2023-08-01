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
            <h1>Ujian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Ujian</a></li>
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
                  <h3 class="card-title">Ujian Anda</h3>
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
                  <th>Nama</th>
                  <th>Materi</th>
                  <th>Soal</th>
                  <th>Kelas</th>
                  <th>Mulai</th>
                  <th>Akhir</th>
                  <th>Nilai</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->nama}}</td>
                  <td>
                    <ul>
                      @foreach($materi[$item->id] as $materiKey => $materiItem)
                        <li>
                          {{$materiItem['nama']}} - <a href="{{$materiItem['file']}}">Lihat</a>
                        </li>
                      @endforeach
                    </ul>
                  </td>
                  <td>{{$item->nama_paket}} - ({{$paket[$item->id]}} Soal)</td>
                  <td>{{$item->nama_kelas}}</td>
                  <td>{{$item->start_date_time}}</td>
                  <td>{{$item->end_date_time}}</td>
                  <td>
                    @if(strtotime($item->end_date_time) >= $now)
                      @if($nilai[$item->id] > 0)
                        @if($percobaan[$item->id] > 1)
                          <ul>
                            @foreach($nilai[$item->id] as $nilaiKey => $itemNilai)
                              <li>
                                Nilai Percobaan Ke - {{$nilaiKey}} : {{$itemNilai}} <br>
                                <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/'.$nilaiKey)}}">Review</a>
                              </li>
                            @endforeach
                          </ul>
                        @else
                          Nilai : {{$nilai[$item->id]}} <br>
                                <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/0')}}">Review</a>
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
                                  Nilai Percobaan Ke - {{$nilaiKey}} : {{$itemNilai}}
                                  <br>
                                  <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/'.$nilaiKey)}}">Review</a>
                              </li>
                            @endforeach
                          </ul>
                        @else
                          Nilai : {{$nilai[$item->id]}} 
                                  <br>
                                  <a href="{{url('simulasi_latihan_mahasiswa_review/'.$item->id.'/'.$item->paket_id.'/0')}}">Review</a>
                        @endif
                      @else
                        Nilai : -
                      @endif
                    @endif
                  </td>
                  
                  <td>
                    @if(strtotime($item->end_date_time) >= $now)
                      @if($nilai[$item->id] > 0)
                        <a href="{{url('simulasi_ujian_kerjakan/'.$item->id.'/'.$item->paket_id.'/'.$soalPertama[$item->id])}}" 
                              style="color: black;" 
                              class="fa fa-edit btn btn-warning btn-sm"> 
                              Kerjakan Ulang
                        </a> 
                      @else
                        @if($pernah[$item->id] != null)
                          <a  href="{{url('simulasi_ujian_kerjakan/'.$item->id.'/'.$item->paket_id.'/'.$pernah[$item->id])}}" 
                              style="color: black;" 
                              class="fa fa-edit btn btn-primary btn-sm"> 
                              Lanjutkan
                          </a>
                        @else
                          <a   href="{{url('simulasi_ujian_kerjakan/'.$item->id.'/'.$item->paket_id.'/'.$soalPertama[$item->id])}}" 
                              style="color: black;" 
                              class="fa fa-edit btn btn-warning btn-sm"> 
                              Kerjakan
                          </a> 
                        @endif
                      @endif
                    @else
                      <a style="cursor: pointer;color: black;" 
                         onclick="return alert('Simulasi Telah Berakahir')" 
                         class="fa fa-edit btn btn-default btn-sm"> 
                        Telah Berakhir
                      </a>
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