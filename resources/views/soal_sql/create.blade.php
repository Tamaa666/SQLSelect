@extends('layouts.main')

@section('css')

@endsection
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Soal SQL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Soal SQL</a></li>
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
                <h3 class="card-title">Tambah Data Soal SQL</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('soal_sql/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if($message=Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-text">{{ucwords($message)}}</div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Soal</label>
                        <textarea class="form-control" name="soal" cols="10" rows="2" required placeholder="Contoh : Tulis Query untuk mendapatkan 10 barang yang memiliki kategori pupuk"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Jawaban SQL</label>
                        <textarea class="form-control" name="jawaban" cols="10" required rows="2" placeholder="Contoh : SELECT * FROM produk WHERE kategori = 'pupuk';"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Table SQL</label>
                        <select class="form-control" name="data_table_id" required>
                          <option selected disabled value="">Pilih Table</option>
                          @foreach($table as $key => $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Bobot Soal</label>
                        <input type="number" step="any" name="bobot" class="form-control" placeholder="Contoh : 5" value="0">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Feedback Benar</label>
                        <textarea class="form-control" name="feedback_benar" cols="10" rows="4" placeholder="Contoh : Selamat jawban anda benar untuk terus meningkatkan pemahaman anda terus belajar ya"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                       <label>Feedback Salah</label>
                        <textarea class="form-control" name="feedback_salah" cols="10" rows="4" placeholder="Contoh : Jawaban anda masih salah, harap perhatkan syntax yang anda upload dan periksa, serta korelasikan dengan petunjuk di soal"></textarea>
                      </div>
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