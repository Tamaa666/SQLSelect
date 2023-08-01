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
              <li class="breadcrumb-item"><a href="#">Review</a></li>
              <li class="breadcrumb-item active">Simulasi</li>
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
            @foreach($soal as $key => $item)
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Soal Ke - {{$key+1}}</h3>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Soal</label>
                         <br>
                         {{$jawaban[$item->soal_id]['soal']}}
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Jawaban Anda</label>
                        <br>
                        {{$jawaban[$item->soal_id]['data']}}
                      </div>
                    </div>
                  </div>
                  @if($jawaban[$item->soal_id]['status'] == 'success')
                  <div class="alert alert-success" role="alert">
                      <label>Koreksi</label>
                      <div class="alert-text">Benar</div>
                  </div>
                  @else
                  <div class="alert alert-danger" role="alert">
                      <label>Koreksi</label>
                      <div class="alert-text">Salah</div>
                  </div>
                  @endif
                  @if($jawaban[$item->soal_id]['status'] == 'success')
                  <div class="alert alert-success" role="alert">
                      <label>Response</label>
                      <div class="alert-text">{{$jawaban[$item->soal_id]['message']}}</div>
                  </div>
                  <div class="alert alert-success" role="alert">
                      <label>Feedback</label>
                      <div class="alert-text">{{$jawaban[$item->soal_id]['feedback_benar']}}</div>
                  </div>
                  @else
                  <div class="alert alert-danger" role="alert">
                      <label>Response</label>
                      <div class="alert-text">{{$jawaban[$item->soal_id]['message']}}</div>
                  </div>
                  <div class="alert alert-danger" role="alert">
                      <label>Feedback</label>
                      <div class="alert-text">{{$jawaban[$item->soal_id]['feedback_salah']}}</div>
                  </div>
                  @endif
                </div>
            </div>
            @endforeach
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