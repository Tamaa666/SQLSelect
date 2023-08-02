<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
use App\Exports\NilaiExport;
use Excel;
class NilaiSimulasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $now = strtotime($now);
        $data = [];
        $materi = [];
        $paket = [];
        $pernah = [];
        $soalPertama = [];
        $nilai = [];
        $percobaan = [];
        if(count($request->all())>0)
        {
            $data = DB::table('simulasi as sml')
                ->join('kelas as kls','kls.id','=','sml.kelas_id')
                ->join('mahasiswa as mhs','mhs.kelas_id','=','kls.id')
                ->join('paket as pk','pk.id','=','sml.paket_id')
                ->where('sml.id',$request->simulasi_id)
                ->select('sml.*','kls.nama as nama_kelas','pk.nama as nama_paket','mhs.id as mahasiswa_id','mhs.nama as nama_mahasiswa')
                ->orderBy('sml.start_date_time','ASC')
                ->get();
            
            foreach ($data as $key => $value) 
            {
                $materi[$value->id] = [];
                $materiSimulasi = DB::table('simulasi_materi')->where('simulasi_id',$value->id)->get();
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
                $nilai[$value->id][$value->mahasiswa_id] = 0;
                $percobaan[$value->id][$value->mahasiswa_id] = 1;
                $dataNilai = DB::table('simulasi_hasil')
                            ->where('simulasi_id',$value->id)
                            ->where('mahasiswa_id',$value->mahasiswa_id)
                            ->groupBy('sesi')
                            ->get();
                if(count($dataNilai) == 1)
                {
                    $dataNilai = DB::table('simulasi_hasil')
                            ->where('simulasi_id',$value->id)
                            ->where('mahasiswa_id',$value->mahasiswa_id)
                            ->first();
                    $nilai[$value->id][$value->mahasiswa_id] = $dataNilai->nilai;
                }elseif(count($dataNilai) > 1)
                {
                    $percobaan[$value->id][$value->mahasiswa_id] = 2;
                    $nilai[$value->id][$value->mahasiswa_id] = [];
                    $dataNilai = DB::table('simulasi_hasil')
                            ->where('simulasi_id',$value->id)
                            ->where('mahasiswa_id',$value->mahasiswa_id)
                            ->get();
                    $sesinya = 0;
                    foreach ($dataNilai as $dataNilaiKey => $dataNilaiValue) 
                    {
                       $sesinya++;
                       $nilai[$value->id][$value->mahasiswa_id][$sesinya] = $dataNilaiValue->nilai;
                    }
                }
            }
        }
        //dd($nilai);
        Session::put('data',$data);
        Session::put('materi',$materi);
        Session::put('now',$now);
        Session::put('paket',$paket);
        Session::put('pernah',$pernah);
        Session::put('soalPertama',$soalPertama);
        Session::put('nilai',$nilai);
        Session::put('percobaan',$percobaan);
        $simulasiList = DB::table('simulasi')->get();
        return view('nilai.index',compact('data','materi','now','paket','pernah','soalPertama','nilai','percobaan','simulasiList','request'));
    }

    public function export() 
    {
        return Excel::download(new NilaiExport, 'nilai.xlsx');
    }
}