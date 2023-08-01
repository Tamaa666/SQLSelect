<table id="example1" >
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
                                Nilai Percobaan Ke - {{$nilaiKey}} : {{$itemNilai}} 
                              </li>
                            @endforeach
                          </ul>
                        @else
                          Nilai : {{$nilai[$item->id]}} 
                                 
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
                              </li>
                            @endforeach
                          </ul>
                        @else
                          Nilai : {{$nilai[$item->id]}}  
                                  
                        @endif
                      @else
                        Nilai : -
                      @endif
                    @endif
                  </td>
                </tr>    
                @endforeach            
              </table>