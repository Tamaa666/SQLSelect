<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class SoalSQLController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('soal_sql as ssql')
                ->join('data_table as dt','dt.id','=','ssql.data_table_id')
                ->select('dt.nama as nama_table','ssql.*')
                ->orderBy('ssql.created_at','DESC')
                ->get();
        return view('soal_sql.index',compact('data'));
    }

    public function create()
    {
        $table = DB::table('data_table')->get();
        return view('soal_sql.create',compact('table'));
    }

    public function store(Request $request)
    {
        $test = $this->readTestTable($request->jawaban);

        if(!is_array($test))
        {
            $test = preg_replace("/[^A-Za-z0-9 ]/", '', $test);
            return redirect()->back()->with('error',$test);
        }
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('soal_sql')->insert([
            'soal'=>$request->soal,
            'jawaban'=>$request->jawaban,
            'data_table_id'=>$request->data_table_id,
            'bobot'=>$request->bobot,
            'feedback_benar'=>$request->feedback_benar,
            'feedback_salah'=>$request->feedback_salah,
            'created_at'=>$createdAt
        ]);

        return redirect('soal_sql')->with('success','Berhasil membuat data soal sql');
    }

    public function edit($id)
    {
        $data = DB::table('soal_sql')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('soal_sql')->with('error','Gagal mendapatkan data soal sql');
        }
        $table = DB::table('data_table')->get();
        return view('soal_sql.edit',compact('data','table'));
    }

    public function update(Request $request,$id)
    {
        $test = $this->readTestTable($request->jawaban);
        // $test = json_decode(json_encode($test),true);
        // $kolom = array_keys($test[0]);
        // unset($kolom['created_at']);
        // dd($kolom);
        if(!is_array($test))
        {
            $test = preg_replace("/[^A-Za-z0-9 ]/", '', $test);
            return redirect()->back()->with('error',$test);
        }
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('soal_sql')->where('id',$id)->update([
            'soal'=>$request->soal,
            'jawaban'=>$request->jawaban,
            'bobot'=>$request->bobot,
            'data_table_id'=>$request->data_table_id,
            'feedback_benar'=>$request->feedback_benar,
            'feedback_salah'=>$request->feedback_salah,
            'updated_at'=>$updatedAt
        ]);
        return redirect('soal_sql')->with('success','Berhasil mengubah data soal sql');
    }

    public function delete($id)
    {
        DB::table('soal_sql')->where('id',$id)->delete();
        return redirect('soal_sql')->with('success','Berhasil menghapus data soal sql');
    }

    public function readTestTable($sql)
    {
        try { 
          $execute = DB::select($sql);
        } catch(\Illuminate\Database\QueryException $ex){ 
          $execute = $ex->getMessage(); 
        }
        return $execute;
    }
}
