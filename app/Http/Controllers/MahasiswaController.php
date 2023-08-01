<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('mahasiswa as mhs')
                ->join('kelas as kls','kls.id','=','mhs.kelas_id')
                ->select('kls.nama as nama_kelas','mhs.*')
               // ->groupBy('mhs.id')
                ->get();
               //dd($data);
        return view('mahasiswa.index',compact('data'));
    }

    public function create()
    {
        $kelas = DB::table('kelas')->get();
        return view('mahasiswa.create',compact('kelas'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        $check = DB::table('users')->where('username',$request->nim)->first();
        if($check)
        {
            return redirect()->back()->with('error','Gagal menambahkan data mahasiswa data dengan nim '.$request->nim.' sudah ada');
        }

        $userId = DB::table('users')->insertGetId([
            'role'=>'mahasiswa',
            'username'=>$request->nim,
            'name'=>$request->nama,
            'password'=>bcrypt($request->nim),
            'created_at'=>$createdAt
        ]);

        DB::table('mahasiswa')->insert([
            'user_id'=>$userId,
            'kelas_id'=>$request->kelas_id,
            'nama'=>$request->nama,
            'nim'=>$request->nim,
            'created_at'=>$createdAt
        ]);

        return redirect('mahasiswa')->with('success','Berhasil membuat data mahasiswa');
    }

    public function edit($id)
    {
        $data = DB::table('mahasiswa')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('mahasiswa')->with('error','Gagal mendapatkan data mahasiswa');
        }
        $kelas = DB::table('kelas')->get();
        return view('mahasiswa.edit',compact('data','kelas'));
    }

    public function update(Request $request,$id)
    {
        $check = DB::table('users')->where('username',$request->nim)->first();
        if($check)
        {
            $mhs = DB::table('mahasiswa')->where('user_id',$check->id)->first();
            if($mhs->id != $id)
            {
                return redirect()->back()->with('error','Gagal mengubah data mahasiswa data dengan nim '.$request->nim.' sudah ada');
            }
        }
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('users')->where('id',$check->id)->update([
            'role'=>'mahasiswa',
            'username'=>$request->nim,
            'name'=>$request->nama,
            'password'=>bcrypt($request->nim),
            'updated_at'=>$updatedAt
        ]);
        DB::table('mahasiswa')->where('id',$id)->update([
            'kelas_id'=>$request->kelas_id,
            'nama'=>$request->nama,
            'nim'=>$request->nim,
            'updated_at'=>$updatedAt
        ]);
        return redirect('mahasiswa')->with('success','Berhasil mengubah data mahasiswa');
    }

    public function delete($id)
    {
        DB::table('mahasiswa')->where('id',$id)->delete();
        return redirect('mahasiswa')->with('success','Berhasil menghapus data mahasiswa');
    }
}
