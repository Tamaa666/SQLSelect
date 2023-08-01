<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class MateriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('materi')->get();
        return view('materi.index',compact('data'));
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        $file = $this->uploadFile($request,'file');
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('materi')->insert([
            'nama'=>$request->nama,
            'deskripsi'=>$request->deskripsi,
            'file'=>$file,
            'created_at'=>$createdAt
        ]);

        return redirect('materi')->with('success','Berhasil membuat data materi');
    }

    public function edit($id)
    {
        $data = DB::table('materi')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('materi')->with('error','Gagal mendapatkan data materi');
        }
        return view('materi.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        if($request->file('file') != null)
        {
            $file = $this->uploadFile($request,'file');
        }else
        {
            $data = DB::table('materi')->where('id',$id)->first();
            $file = $data->file;
        }
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('materi')->where('id',$id)->update([
            'nama'=>$request->nama,
            'deskripsi'=>$request->deskripsi,
            'file'=>$file,
            'updated_at'=>$updatedAt
        ]);
        return redirect('materi')->with('success','Berhasil mengubah data materi');
    }

    public function delete($id)
    {
        DB::table('materi')->where('id',$id)->delete();
        return redirect('materi')->with('success','Berhasil menghapus data materi');
    }

    public function uploadFile(Request $request, $oke)
    {
        $result = '';
        $file = $request->file($oke);
        $name = $file->getClientOriginalName();
        $extension = explode('.', $name);
        $extension = strtolower(end($extension));
        $key = rand() . '_' . $oke . '_materi';
        $tmp_file_name = "{$key}.{$extension}";
        $tmp_file_path = "asset_application/materi";
        $file->move($tmp_file_path, $tmp_file_name);
        $result = $tmp_file_name;
        return $result;
    }
}
