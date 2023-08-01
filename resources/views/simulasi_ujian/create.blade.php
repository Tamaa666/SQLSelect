@extends('layouts.main')

@section('css')

@endsection
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Ujian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"> Ujian</a></li>
              <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title">Tambah Data  Ujian</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('simulasi_ujian/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if($message=Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-text">{{ucwords($message)}}</div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nama  Ujian</label>
                        <input type="text" name="nama" required class="form-control" placeholder="Contoh : LATIHAN SELECT *">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="kelas_id" required>
                          <option selected disabled value="">Pilih kelas</option>
                          @foreach($kelas as $kelasKey => $kelasItem)
                            <option value="{{$kelasItem->id}}">{{$kelasItem->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Paket Soal</label>
                        <select class="form-control" name="paket_id" required>
                          <option selected disabled value="">Pilih Paket Soal</option>
                          @foreach($paket as $paketKey => $paketItem)
                            <option value="{{$paketItem->id}}">{{$paketItem->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Dekripsi </label>
                        <textarea class="form-control" name="deskripsi" cols="10" rows="5" placeholder=" ini ditujukan..."></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Dibuka Pada</label>
                       <input type="datetime-local" name="start_date_time" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Ditutup Pada</label>
                       <input type="datetime-local" name="end_date_time" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Auto Grading</label>
                        <br>
                       <input type="radio" name="autograding" value="iya"  required checked> Iya
                       &nbsp;
                       <input type="radio" name="autograding" value="tidak"  required> Tidak
                      </div>
                      <small>Info : Jika autograding bernilai tidak maka hasil dari simulasi akan dikalikan bobot soal : Σbenar x bobot soal, jika bernilai iya maka akan hasil dari simulasi akan Σbenar / Σsoal x 100</small>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Skip</label>
                        <br>
                       <input type="radio" name="skip" value="1"  required checked> Iya
                       &nbsp;
                       <input type="radio" name="skip" value="0"  required> Tidak
                      </div>
                      <small>Info : Jika skip bernilai iya maka soal bisa diskip (mengabaikan benar salahnya) jika tidak maka per soal harus benar terlebih dahulu</small>
                    </div>
                  </div>

                  <div class="row">
                    
                    <div class="col-sm-12" align="center">
                      <p align="center">
                        Pilih Materi - Silahkan Checklist materi-materi yang ingin di masukkan 
                      </p>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Deskripsi</th>
                          <th>File</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materi as $key => $item)
                        <tr>
                          <td>
                            <div class="form-check">
                              <input type="checkbox" name="materi_id[]" value="{{$item->id}}" class="form-check-input" id="exampleCheck1{{$item->id}}">
                              <label class="form-check-label" for="exampleCheck1{{$item->id}}"></label>
                            </div>
                          </td>
                          <td>{{$item->nama}}</td>
                          <td>{{$item->deskripsi}}</td>
                          <td>
                            <a href="{{url('asset_application/soal/'.$item->file)}}" class="fa fa-file-code-o" target="_blank"> 
                              Lihat
                            </a>
                          </td>
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
@endsection