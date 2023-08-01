<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class PaketSoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('paket')->get();
        $soal = [];
        foreach ($data as $key => $value) 
        {
           $soalPaket = DB::table('paket_soal')->where('paket_id',$value->id)->get();
           foreach ($soalPaket as $soalPaketKey => $soalPaketValue) 
           {
                $item = DB::table('soal_sql')->where('id',$soalPaketValue->soal_id)->first();
                if($item)
                {
                    $soal[$value->id][$soalPaketKey]['soal'] = $item->soal;
                    $soal[$value->id][$soalPaketKey]['jawaban'] = $item->jawaban;
                }  
           } 
        }
        return view('paket_soal.index',compact('data','soal'));
    }

    public function create()
    {
        $soal = DB::table('soal_sql as ssql')
                ->join('data_table as dt','dt.id','=','ssql.data_table_id')
                ->select('dt.nama as nama_table','ssql.*')
                ->orderBy('ssql.created_at','DESC')
                ->get();
        return view('paket_soal.create',compact('soal'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $paketId = DB::table('paket')->insertGetId([
                'nama'=>$request->nama,
                'created_at'=>$createdAt
            ]);
        if($request->soal_id)
        {
            foreach ($request->soal_id as $key => $value) 
            {
                DB::table('paket_soal')->insert([
                    'paket_id'=>$paketId,
                    'soal_id'=>$value,
                    'created_at'=>$createdAt
                ]);
            }
            return redirect('paket_soal')->with('success','Berhasil membuat data paket');
        }else
        {
            return redirect()->back()->with('error','Gagal membuat data paket, setidaknya centang salah satu soal');
        }
    }

    public function edit($id)
    {
        $data = DB::table('paket')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('paket_soal')->with('error','Gagal mendapatkan data paket');
        }
        $soal = DB::table('soal_sql as ssql')
                ->join('data_table as dt','dt.id','=','ssql.data_table_id')
                ->select('dt.nama as nama_table','ssql.*')
                ->orderBy('ssql.created_at','DESC')
                ->get();
        $soalSelected = [];
        $soalPaket = DB::table('paket_soal')->where('paket_id',$id)->get();
        foreach ($soalPaket as $key => $value) 
        {
            array_push($soalSelected, $value->soal_id);
        }
        return view('paket_soal.edit',compact('data','soal','soalSelected'));
    }

    public function update(Request $request,$id)
    {
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('paket')->where('id',$id)->update([
            'nama'=>$request->nama,
            'updated_at'=>$updatedAt
        ]);
        DB::table('paket_soal')->where('paket_id',$id)->delete();
         if($request->soal_id)
        {
            foreach ($request->soal_id as $key => $value) 
            {
                DB::table('paket_soal')->insert([
                    'paket_id'=>$id,
                    'soal_id'=>$value,
                    'created_at'=>$updatedAt
                ]);
            }
            return redirect('paket_soal')->with('success','Berhasil mengubah data paket soal');
        }else
        {
            return redirect()->back()->with('error','Gagal mengubah data paket, setidaknya centang salah satu  soal');
        }
        
    }

    public function delete($id)
    {
        DB::table('paket_soal')->where('id',$id)->delete();
        return redirect('paket_soal')->with('success','Berhasil menghapus data paket soal ');
    }
}
