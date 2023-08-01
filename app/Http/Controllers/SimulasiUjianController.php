<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class SimulasiUjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('simulasi as sml')
                ->join('kelas as kls','kls.id','=','sml.kelas_id')
                ->join('paket as pk','pk.id','=','sml.paket_id')
                ->where('sml.type','ujian')
                ->select('sml.*','kls.nama as nama_kelas','pk.nama as nama_paket')
                ->get();
        $materi = [];
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
        }
        return view('simulasi_ujian.index',compact('data','materi'));
    }

    public function create()
    {
        $kelas = DB::table('kelas')->get();
        $paket = DB::table('paket')->get();
        $materi = DB::table('materi')->get();
        return view('simulasi_ujian.create',compact('kelas','paket','materi'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $smlId = DB::table('simulasi')->insertGetId([
                'nama'=>$request->nama,
                'type'=>'ujian',
                'deskripsi'=>$request->deskripsi,
                'autograding'=>$request->autograding,
                'skip'=>$request->skip,
                'paket_id'=>$request->paket_id,
                'kelas_id'=>$request->kelas_id,
                'start_date_time'=>$request->start_date_time,
                'end_date_time'=>$request->end_date_time,
                'created_at'=>$createdAt
            ]);
        //materi
        if($request->materi_id)
        {
            foreach ($request->materi_id as $key => $value) 
            {
               DB::table('simulasi_materi')->insert([
                    'materi_id'=>$value,
                    'simulasi_id'=>$smlId,
                    'type'=>'ujian',
                    'created_at'=>$createdAt,
                    'updated_at'=>$createdAt
                ]);
            }
        }
        return redirect('simulasi_ujian')->with('success','Berhasil membuat data simulasi');
    }

    public function edit($id)
    {
        $data = DB::table('simulasi')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('simulasi_ujian')->with('error','Gagal mendapatkan data simulasi');
        }
        $kelas = DB::table('kelas')->get();
        $paket = DB::table('paket')->get();
        $materi = DB::table('materi')->get();
        $materiSelected = [];

        $simulasiMateri = DB::table('simulasi_materi')->where('simulasi_id',$id)->get(); 
        foreach ($simulasiMateri as $key => $value) 
        {
            array_push($materiSelected, $value->materi_id);
        }
        return view('simulasi_ujian.edit',compact('data','kelas','paket','materi','materiSelected'));
    }

    public function update(Request $request,$id)
    {
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('simulasi')->where('id',$id)->update([
            'nama'=>$request->nama,
            'type'=>'ujian',
            'paket_id'=>$request->paket_id,
            'skip'=>$request->skip,
            'autograding'=>$request->autograding,
            'kelas_id'=>$request->kelas_id,
            'deskripsi'=>$request->deskripsi,
            'start_date_time'=>$request->start_date_time,
            'end_date_time'=>$request->end_date_time,
            'updated_at'=>$updatedAt
        ]);
        DB::table('simulasi_materi')->where('simulasi_id',$id)->delete();
        //materi
        if($request->materi_id)
        {
            foreach ($request->materi_id as $key => $value) 
            {
               DB::table('simulasi_materi')->insert([
                    'materi_id'=>$value,
                    'simulasi_id'=>$id,
                    'type'=>'ujian',
                    'created_at'=>$updatedAt,
                    'updated_at'=>$updatedAt
                ]);
            }
        }
        return redirect('simulasi_ujian')->with('success','Berhasil mengubah data simulasi');
    }

    public function delete($id)
    {
        DB::table('simulasi')->where('id',$id)->delete();
        return redirect('simulasi_ujian')->with('success','Berhasil menghapus data simulasi');
    }
}
