<!-- The Modal -->
<div class="modal" id="myModalSoal{{$item->id}}">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Daftar Soal Paket {{$item->nama}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        @foreach($soal[$item->id] as $soalKey => $soalItem)
          <ul>
              <li>
                <b>Soal Ke - {{$soalKey+1}}</b>: <br><p>{{$soalItem['soal']}}</p>
                <ul>
                   <li>
                    <b>Jawaban</b> : <br><p>{{$soalItem['jawaban']}}</p>
                  </li>
                </ul>
              </li>
          </ul>
        @endforeach
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
