<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class SimulasiUjianMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $now = strtotime($now);
        $mhs = DB::table('mahasiswa')->where('user_id',Auth::user()->id)->first();
        $data = DB::table('simulasi as sml')
                ->join('kelas as kls','kls.id','=','sml.kelas_id')
                ->join('paket as pk','pk.id','=','sml.paket_id')
                ->where('sml.type','ujian')
                ->where('sml.kelas_id',$mhs->kelas_id)
                ->select('sml.*','kls.nama as nama_kelas','pk.nama as nama_paket')
                ->orderBy('sml.start_date_time','ASC')
                ->get();
        $materi = [];
        $paket = [];
        $pernah = [];
        $soalPertama = [];
        $nilai = [];
        $percobaan = [];
        foreach ($data as $key => $value) 
        {
            $materi[$value->id] = [];
            $materiSimulasi = DB::table('simulasi_materi')->where('type','ujian')->where('simulasi_id',$value->id)->get();
            foreach ($materiSimulasi as $materiSimulasiKey => $materiSimulasiValue) 
            {
                $materiData = DB::table('materi')->where('id',$materiSimulasiValue->materi_id)->first();
                if($materiData)
                {
                    $materi[$value->id][$materiSimulasiKey]['nama'] = $materiData->nama;
                    $materi[$value->id][$materiSimulasiKey]['file'] = url('/asset_application/materi').'/'.$materiData->file;
                }
            }

            $paketdata = DB::table('paket_soal as pk')
                        ->join('soal_sql as soal','soal.id','=','pk.soal_id')
                        ->where('pk.paket_id',$value->paket_id)
                        ->count();
            $paket[$value->id] = $paketdata;

            $soalPertama[$value->id] = 0;
            $pakeSoalPertama = DB::table('paket_soal as pk')
                                ->join('soal_sql as soal','soal.id','=','pk.soal_id')
                                ->where('pk.paket_id',$value->paket_id)
                                ->select('soal.id')
                                ->orderBy('soal.id','ASC')
                                ->first();
            if($pakeSoalPertama)
            {
                $soalPertama[$value->id] = $pakeSoalPertama->id;
            }

            $pernah[$value->id] = null;
            $simulasiLog = DB::table('simulasi_log')
                          ->where('simulasi_id',$value->id)
                          ->where('mahasiswa_id',$mhs->id)
                          ->where('type','ujian')
                          ->groupBy('soal_id')
                          ->orderBy('created_at','DESC')
                          ->first();
            if($simulasiLog)
            {
                $pernah[$value->id] = $simulasiLog->soal_id;
            }

            $nilai[$value->id] = 0;
            $percobaan[$value->id] = 1;
            $dataNilai = DB::table('simulasi_hasil')
                        ->where('simulasi_id',$value->id)
                        ->where('mahasiswa_id',$mhs->id)
                        ->where('type','ujian')
                        ->groupBy('sesi')
                        ->get();
            if(count($dataNilai) == 1)
            {
                $dataNilai = DB::table('simulasi_hasil')
                        ->where('simulasi_id',$value->id)
                        ->where('mahasiswa_id',$mhs->id)
                        ->where('type','ujian')
                        ->first();
                $nilai[$value->id] = $dataNilai->nilai;
            }elseif(count($dataNilai) > 1)
            {
                $percobaan[$value->id] = 2;
                $nilai[$value->id] = [];
                $dataNilai = DB::table('simulasi_hasil')
                        ->where('simulasi_id',$value->id)
                        ->where('mahasiswa_id',$mhs->id)
                        ->where('type','ujian')
                        ->get();
                       // dd($dataNilai);
                $sesinya = 0;
                foreach ($dataNilai as $dataNilaiKey => $dataNilaiValue) 
                {
                   $sesinya++;
                   $nilai[$value->id][$sesinya] = $dataNilaiValue->nilai;
                }
            }
        }
        //dd($nilai);
        return view('simulasi_ujian_mahasiswa.index',compact('data','materi','now','paket','pernah','soalPertama','nilai','percobaan'));
    }

    public function kerjakan($simulasi_id,$paket_id,$soal_id)
    {

        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $now = strtotime($now);
        $mhs = DB::table('mahasiswa')->where('user_id',Auth::user()->id)->first();
        $simulasi = DB::table('simulasi')->where('id',$simulasi_id)->first();
        if(!$simulasi)
        {
            return redirect()->back()->with('error','data simulasi tidak ditemukan');
        }
        $dataNilai = DB::table('simulasi_hasil')
                     ->where('simulasi_id',$simulasi_id)
                     ->where('mahasiswa_id',$mhs->id)
                     ->where('type','ujian')
                     ->count();
        $sesi = 1 + $dataNilai;
        if(strtotime($simulasi->end_date_time) < $now)
        {
            $this->selesai($simulasi_id,'habis_waktu',$sesi);
            return redirect()->back()->with('error','simulasi sudah berakhir data nilai ada dimasukkan seadaanya');
        }
        $paket = DB::table('paket')->where('id',$paket_id)->first();
        if(!$paket)
        {
            return redirect()->back()->with('error','data paket soal tidak ditemukan');
        }
        $soal = DB::table('soal_sql')->where('id',$soal_id)->first();
        if(!$soal)
        {
            return redirect()->back()->with('error','data soal tidak ditemukan');
        }

        $selesai = 0;
        $soalKe = 1;
        $logSoalArr = [];
        $log = DB::table('simulasi_log')
               ->where('simulasi_id',$simulasi_id)
               ->where('mahasiswa_id',$mhs->id)
               ->where('sesi',$sesi)
               ->where('type','ujian')
               ->groupBy('soal_id')
               ->orderBy('created_at','DESC')
               ->get();
        foreach ($log as $key => $value) 
        {
            array_push($logSoalArr, $value->soal_id);
        }
        if(count($logSoalArr) > 0)
        {
            $soalKe += count($logSoalArr);
            $soalBerikutnya = DB::table('paket_soal')
                            ->where('paket_id',$paket_id)
                            ->whereNotIn('soal_id',$logSoalArr)
                            ->orderBy('soal_id','ASC')
                            ->first();
            if($soalBerikutnya)
            {
                $soalBerikutnya = $soalBerikutnya->soal_id;
                $soal = DB::table('soal_sql')->where('id',$soalBerikutnya)->first();
            }else
            {
                $selesai = 1;
                return $this->selesai($simulasi_id,'selesai',$sesi);
            }
        }else
        {
            $soalBerikutnya = DB::table('paket_soal')
                        ->where('paket_id',$paket_id)
                        ->where('soal_id','!=',$soal_id)
                        ->orderBy('soal_id','ASC')
                        ->first();
            $soalBerikutnya = $soalBerikutnya->soal_id;
        }
        $table = DB::table('data_table')->where('id',$soal->data_table_id)->first();
        $petunjukSoal = 'SELECT * FROM '.$table->nama.'';
        $petunjuk = $this->executeSql($petunjukSoal);
        if(!is_array($petunjuk))
        {
            return redirect('simulasi_ujian_mahasiswa')->with('error','Data pendukung pada simulasi ini tidak ditemukan atau tidak dapat digunakan silahkan hubungi dosen anda');
        }
        $petunjuk = json_decode(json_encode($petunjuk),true);
        $petunjukKolom = array_keys($petunjuk[0]);
        return view('simulasi_ujian_mahasiswa.kerjakan',compact('simulasi','paket','soal','now','soalBerikutnya','selesai','soalKe','petunjukKolom','petunjuk'));
    }

    public function selesai($simulasi_id,$type,$sesi)
    {
       $mhs = DB::table('mahasiswa')->where('user_id',Auth::user()->id)->first();
       $nilai = 0;
       $simulasi = DB::table('simulasi')->where('id',$simulasi_id)->first();
       if($simulasi)
       {
        $log = DB::table('simulasi_log')
               ->where('simulasi_id',$simulasi_id)
               ->where('mahasiswa_id',$mhs->id)
               ->where('sesi',$sesi)
               ->where('type','ujian')
               ->where('status','right')
               ->groupBy('soal_id')
               ->orderBy('created_at','DESC')
               ->get();
           $totalSoal = DB::table('paket_soal')->where('paket_id',$simulasi->paket_id)->get();
           if($simulasi->autograding == 'iya')
           {
              $soalTotalBenar = count($log);
              $jumlahSoal = count($totalSoal);
              $nilai = $soalTotalBenar / $jumlahSoal * 100;
             // dd($nilai);
           }else
           {
              foreach ($log as $key => $value) 
              {
                  $soal = DB::table('soal_sql')->where('id',$value->soal_id)->first();
                  if($soal)
                  {
                    $bobot = $soal->bobot;
                    $nilai += $bobot;
                  }
              }
           }
           $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
           $oke = DB::table('simulasi_hasil')->insert([
                'simulasi_id'=>$simulasi_id,
                'mahasiswa_id'=>$mhs->id,
                'nilai'=>$nilai,
                'sesi'=>$sesi,
                'type'=>'ujian',
                'created_at'=>$createdAt
            ]);
           //dd($oke);
           if($type == 'selesai')
           {
                return redirect('simulasi_ujian_mahasiswa')->with('success','Simulai sudah selesai dikerjakan');
           }
       }else
       {
           return redirect()->back()->with('error','data simulasi tidak ditemukan');
       }
    }

    public function lanjut(Request $request)
    {
        if($request->log_file == null)
        {
            return redirect()->back()->with('error','harap isi kode anda!');
        }else
        {   
            $mhs = DB::table('mahasiswa')->where('user_id',Auth::user()->id)->first();
            $simulasi = DB::table('simulasi')->where('id',$request->simulasi_id)->first();
            $status = 'not';
            $dataNilai = DB::table('simulasi_hasil')
                        ->where('simulasi_id',$request->simulasi_id)
                        ->where('mahasiswa_id',$mhs->id)
                        ->where('type','ujian')
                        ->count();
            $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $sesi = 1;
            if($dataNilai > 0)
            {
                $sesi += $dataNilai;
            }

            $soal = DB::table('soal_sql')->where('id',$request->soal_id)->first();

            $jawban = $request->log_file;
            $stateMent = $request->log_file;

            //check SQL
            $message = null;
            $sqlJawaban = $this->executeSql($stateMent);
            if(!is_array($sqlJawaban))
            {
                $sqlJawaban = str_replace(env('DB_DATABASE'), '', $sqlJawaban);
                $message = $sqlJawaban;
                $message = str_replace('; check the manual that corresponds to your MariaDB server version for the right syntax to use', '', $message);
                $message = str_replace('SQLSTATE', '', $message);
                $message = str_replace('[', '', $message);
                $message = str_replace(']', '', $message);
                $message = str_replace('42000:', '', $message);
                $message = str_replace('1064', '', $message);
                $message = str_replace('(Connection: mysql, SQL: '.$stateMent.')', '', $message);
                Session::put('syntax',$request->log_file);
                if($request->button != 'jalankan')
                {
                    if($simulasi->skip)
                    {
                        DB::table('simulasi_log')->insert([
                            'mahasiswa_id'=>$mhs->id,
                            'type'=>'ujian',
                            'paket_id'=>$request->paket_id,
                            'soal_id'=>$request->soal_id,
                            'simulasi_id'=>$request->simulasi_id,
                            'file'=>$jawban,
                            'status'=>$status,
                            'message'=>$message,
                            'sesi'=>$sesi,
                            'created_at'=>$createdAt,
                            'updated_at'=>$createdAt
                        ]);
                        Session::forget('benar');
                        Session::forget('syntax');
                        return redirect('simulasi_ujian_kerjakan'.'/'.$request->simulasi_id.'/'.$request->paket_id.'/'.$request->soal_id);
                    }
                }
                if($simulasi->skip)
                {
                    Session::put('benar','1');
                }else
                {
                    Session::forget('benar');
                }
                return redirect()->back()->with('error',$message);
            }else
            {
                $benar = 0;
                $jmlJawabanSoal = 0;
                if($soal)
                {
                    $tableName = null;
                    $namaTable = explode('from ', $request->log_file);
                    if(isset($namaTable[1]))
                    {
                        $namaTable = explode(' ', $namaTable[1]);
                        if(isset($namaTable[0]))
                        {
                            $tableName = $namaTable[0];
                        }
                    }

                    if($tableName == null)
                    {
                        $namaTable = explode('FROM ', $request->log_file);

                        if(isset($namaTable[1]))
                        {
                            $namaTable = explode(' ', $namaTable[1]);
                            if(isset($namaTable[0]))
                            {
                                //dd($namaTable);
                                $tableName = $namaTable[0];
                            }
                        }
                    }
                   // dd($tableName);
                    $tableNameJawaban = null;
                    $namaTable = explode('from ', $soal->jawaban);
                    if(isset($namaTable[1]))
                    {
                        $namaTable = explode(' ', $namaTable[1]);
                        if(isset($namaTable[0]))
                        {
                            $tableNameJawaban = $namaTable[0];
                        }
                    }

                    if($tableNameJawaban == null)
                    {
                        $namaTable = explode('FROM ', $soal->jawaban);
                        if(isset($namaTable[1]))
                        {
                            $namaTable = explode(' ', $namaTable[1]);
                            if(isset($namaTable[0]))
                            {
                                $tableNameJawaban = $namaTable[0];
                            }
                        }
                    }

                    if($tableName != $tableNameJawaban)
                    {
                        $status = 'not';
                        $message = 'Nama table yang yang dipilih tidak sesuai, harusnya nama table nya  '.$tableNameJawaban.' ';
                        if($request->button != 'jalankan')
                        {
                            if($simulasi->skip)
                            {
                                DB::table('simulasi_log')->insert([
                                    'mahasiswa_id'=>$mhs->id,
                                    'type'=>'ujian',
                                    'paket_id'=>$request->paket_id,
                                    'soal_id'=>$request->soal_id,
                                    'simulasi_id'=>$request->simulasi_id,
                                    'file'=>$jawban,
                                    'status'=>$status,
                                    'message'=>$message,
                                    'sesi'=>$sesi,
                                    'created_at'=>$createdAt,
                                    'updated_at'=>$createdAt
                                ]);
                                Session::forget('benar');
                                Session::forget('syntax');
                                return redirect('simulasi_ujian_kerjakan'.'/'.$request->simulasi_id.'/'.$request->paket_id.'/'.$request->soal_id);
                            }
                        }
                        Session::put('syntax',$request->log_file);
                        if($simulasi->skip)
                        {
                            Session::put('benar','1');
                        }else
                        {
                            Session::forget('benar');
                        }
                        return redirect()->back()->with('error',$message);
                    }

                    $sqlJawaban = json_decode(json_encode($sqlJawaban),true);
                    $sqlSoal = $this->executeSql($soal->jawaban);
                    if(is_array($sqlJawaban))
                    {
                        if(count($sqlJawaban) > 0)
                        {
                           $sqlSoal = json_decode(json_encode($sqlSoal),true);
                           if(is_array($sqlSoal))
                           {
                               if(isset($sqlSoal[0]))
                               {
                                   $kolom = array_keys($sqlSoal[0]);
                                   if(count($sqlJawaban) == count($sqlSoal))
                                   {
                                        foreach ($sqlSoal as $sqlSoalKey => $sqlSoalvalue) 
                                        {
                                            foreach ($kolom as $kolomkey => $kolomvalue) 
                                            {
                                                if(isset($sqlJawaban[$sqlSoalKey]))
                                                {
                                                    if(isset($sqlJawaban[$sqlSoalKey][$kolomvalue]) && isset($sqlSoal[$sqlSoalKey][$kolomvalue]))
                                                    {
                                                        $jmlJawabanSoal++;
                                                        if($sqlJawaban[$sqlSoalKey][$kolomvalue] == $sqlSoal[$sqlSoalKey][$kolomvalue])
                                                        {
                                                            $benar++;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                   }
                               }
                           }
                        }
                    }
                    //checking
                    if($benar > 0 && $jmlJawabanSoal > 0)
                    {
                        if($benar == $jmlJawabanSoal)
                        {
                            $status = 'right';
                            $message = 'syntax berhasil di eksekusi dan jawaban sudah sesuai anda bisa melanjutkan ke soal berikutnya';
                            if($request->button == 'jalankan')
                            {
                                Session::put('syntax',$request->log_file);
                                Session::put('benar','1');
                                return redirect()->back()->with('success',$message);
                            }else
                            {
                                DB::table('simulasi_log')->insert([
                                    'mahasiswa_id'=>$mhs->id,
                                    'type'=>'ujian',
                                    'paket_id'=>$request->paket_id,
                                    'soal_id'=>$request->soal_id,
                                    'simulasi_id'=>$request->simulasi_id,
                                    'file'=>$jawban,
                                    'status'=>$status,
                                    'message'=>$message,
                                    'sesi'=>$sesi,
                                    'created_at'=>$createdAt,
                                    'updated_at'=>$createdAt
                                ]);
                                Session::forget('benar');
                                Session::forget('syntax');
                                return redirect('simulasi_ujian_kerjakan'.'/'.$request->simulasi_id.'/'.$request->paket_id.'/'.$request->soal_id);
                            }
                        }else{
                            $status = 'not';
                            $message = 'syntax berhasil di eksekusi akan tetapi jawaban belum sesuai jumlah data record belum sesuai';
                            if($request->button != 'jalankan')
                            {
                                if($simulasi->skip)
                                {
                                    DB::table('simulasi_log')->insert([
                                        'mahasiswa_id'=>$mhs->id,
                                        'type'=>'ujian',
                                        'paket_id'=>$request->paket_id,
                                        'soal_id'=>$request->soal_id,
                                        'simulasi_id'=>$request->simulasi_id,
                                        'file'=>$jawban,
                                        'status'=>$status,
                                        'message'=>$message,
                                        'sesi'=>$sesi,
                                        'created_at'=>$createdAt,
                                        'updated_at'=>$createdAt
                                    ]);
                                    Session::forget('benar');
                                    Session::forget('syntax');
                                    return redirect('simulasi_ujian_kerjakan'.'/'.$request->simulasi_id.'/'.$request->paket_id.'/'.$request->soal_id);
                                }
                            }
                            Session::put('syntax',$request->log_file);
                            if($simulasi->skip)
                            {
                                Session::put('benar','1');
                            }else
                            {
                                Session::forget('benar');
                            }
                            return redirect()->back()->with('error',$message);
                        }
                    }else
                    {
                        $status = 'not';
                        $message = $stateMent;
                        $message = 'syntax berhasil di eksekusi akan tetapi jawaban belum sesuai jumlah data bari tidak sesuai';
                        if($request->button != 'jalankan')
                        {
                            if($simulasi->skip)
                            {
                                DB::table('simulasi_log')->insert([
                                    'mahasiswa_id'=>$mhs->id,
                                    'type'=>'ujian',
                                    'paket_id'=>$request->paket_id,
                                    'soal_id'=>$request->soal_id,
                                    'simulasi_id'=>$request->simulasi_id,
                                    'file'=>$jawban,
                                    'status'=>$status,
                                    'message'=>$message,
                                    'sesi'=>$sesi,
                                    'created_at'=>$createdAt,
                                    'updated_at'=>$createdAt
                                ]);
                                Session::forget('benar');
                                Session::forget('syntax');
                                return redirect('simulasi_ujian_kerjakan'.'/'.$request->simulasi_id.'/'.$request->paket_id.'/'.$request->soal_id);
                            }
                        }
                        Session::put('syntax',$request->log_file);
                        if($simulasi->skip)
                        {
                            Session::put('benar','1');
                        }else
                        {
                            Session::forget('benar');
                        }
                        return redirect()->back()->with('error',$message);
                    }
                }else
                {
                    return redirect('simulasi_ujian_mahasiswa')->with('error','data soal tidak ditemukan');
                }
            }
        }
    }

    public function executeSql($sqlJawaban)
    {
        try { 
            $sqlJawaban = DB::select($sqlJawaban);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $sqlJawaban = $ex->getMessage(); 
        }

        return $sqlJawaban;
    }

    public function uploadFile(Request $request, $oke)
    {
        $mhs = DB::table('mahasiswa')->where('user_id',Auth::user()->id)->first();
        $result = '';
        $file = $request->file($oke);
        $name = $file->getClientOriginalName();
        $extension = explode('.', $name);
        $extension = strtolower(end($extension));
        $key = rand() . '_' . $request->simulasi_id.'_ujian_'.$request->soal_id.'_'.$mhs->id.'_log';
        $tmp_file_name = "{$key}.{$extension}";
        $tmp_file_path = "asset_application/jawaban/ujian";
        $file->move($tmp_file_path, $tmp_file_name);
        $result = $tmp_file_name;
        return $result;
    }

    public function review($simulasi_id,$paket_id,$sesi)
    {
        $soal = DB::table('paket_soal')->where('paket_id',$paket_id)->get();
        $mhs = DB::table('mahasiswa')->where('user_id',Auth::user()->id)->first();
        $simulasi = DB::table('simulasi')->where('id',$simulasi_id)->first();
        $jawaban = [];
        foreach ($soal as $key => $value) 
        {
            if($sesi == 0)
            {
                $log = DB::table('simulasi_log')->where('simulasi_id',$simulasi_id)
                  ->where('mahasiswa_id',$mhs->id)
                  ->where('paket_id',$paket_id)
                  ->where('soal_id',$value->soal_id)
                  ->first();
            }else
            {
                $log = DB::table('simulasi_log')->where('simulasi_id',$simulasi_id)
                  ->where('mahasiswa_id',$mhs->id)
                  ->where('paket_id',$paket_id)
                  ->where('soal_id',$value->soal_id)
                  ->where('sesi',$sesi)
                  ->first();
            }
            if($log)
            {
                $soalSql = DB::table('soal_sql')->where('id',$value->soal_id)->first();
                if($soalSql)
                {
                    $jawaban[$value->soal_id]['soal'] = $soalSql->soal;
                    $jawaban[$value->soal_id]['data'] = $log->file;
                    $jawaban[$value->soal_id]['message'] = $log->message;
                    if($log->status == 'right')
                    {
                        $jawaban[$value->soal_id]['status'] = 'success';
                    }else
                    {
                        $jawaban[$value->soal_id]['status'] = 'danger';
                    }
                    $jawaban[$value->soal_id]['feedback_benar'] = $soalSql->feedback_benar;
                    $jawaban[$value->soal_id]['feedback_salah'] = $soalSql->feedback_salah;
                }
            }
        }
        return view('simulasi_latihan_mahasiswa.review',compact('jawaban','simulasi','soal'));
    }
}
