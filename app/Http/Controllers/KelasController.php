<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('kelas')->get();
        return view('kelas.index',compact('data'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('kelas')->insert([
            'nama'=>$request->nama,
            'created_at'=>$createdAt
        ]);

        return redirect('kelas')->with('success','Berhasil membuat data kelas');
    }

    public function edit($id)
    {
        $data = DB::table('kelas')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('kelas')->with('error','Gagal mendapatkan data kelas');
        }
        return view('kelas.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('kelas')->where('id',$id)->update([
            'nama'=>$request->nama,
            'updated_at'=>$updatedAt
        ]);
        return redirect('kelas')->with('success','Berhasil mengubah data kelas');
    }

    public function delete($id)
    {
        DB::table('kelas')->where('id',$id)->delete();
        return redirect('kelas')->with('success','Berhasil menghapus data kelas');
    }
}
