@extends('layouts.main')

@section('css')

@endsection
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$simulasi->nama}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Mengerjakan</a></li>
              <li class="breadcrumb-item active">Soal</li>
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
                <h3 class="card-title">Soal Ke - {{$soalKe}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('simulasi_ujian_submit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if($message=Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-text">{{strtolower($message)}}</div>
                    </div>
                  @endif

                  @if($message=Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="alert-text">{{strtolower($message)}}</div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Soal</label>
                        <input type="hidden" name="soal_id" value="{{$soal->id}}">
                        <input type="hidden" name="paket_id" value="{{$paket->id}}">
                        <input type="hidden" name="simulasi_id" value="{{$simulasi->id}}">
                         <br>{{$soal->soal}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Jawaban Anda</label>
                        <textarea class="form-control" cols="5" rows="5" name="log_file" required placeholder="Contoh : SELECT * FROM table_1">{{Session::get('syntax')}}</textarea>
                      </div>
                    </div>
                  </div>
                  <br>

                  <div class="card collapsed-card">
                    <div class="card-header">
                      <h5 class="card-title" align="center">
                        <j style="color: red;">Data Pendukung</j> : (Tekan Tombol - (minus) untuk memperkecil dan + (plus) untuk melihat data)
                      </h5>
                      <div class="card-tools">
                        <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body" style="display: none;">
                      <div class="row ">
                        <div class="col-sm-12 table-responsive">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                  @foreach($petunjukKolom as $petunjukKolomKey => $petunjukKolomItem)
                                    <th>{{$petunjukKolomItem}}</th>
                                  @endforeach
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($petunjuk as $petunjukKey => $petunjukItem)
                              <tr>
                                  @foreach($petunjukKolom as $petunjukKolomKey => $petunjukKolomItem)
                                    <td>{{$petunjukItem[$petunjukKolomItem]}}</td>
                                  @endforeach
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="right">
                  <button type="submit" class="btn btn-success" name="button" value="jalankan">Jalankan <i class="fa fa-play"></i></button>
                  &nbsp;
                  <button type="submit" {{Session::get('benar') == null ? 'disabled':''}} class="btn btn-primary" name="button" value="lanjut">Selanjutnya <i class="fa fa-arrow-right"></i></button>
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