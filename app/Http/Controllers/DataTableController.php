<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class DataTableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('data_table')->orderBy('created_at','DESC')->get();
        return view('data_table.index',compact('data'));
    }

    public function create()
    {
        return view('data_table.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $file = $this->uploadFile($request,'file');
        $execute = $this->readAnCreateTable($file);
        if(!is_bool($execute))
        {
            $execute = preg_replace("/[^A-Za-z0-9 ]/", '', $execute);
            unlink('asset_application/soal/'.$file);
            return redirect()->back()->with('error',$execute);
        }
        
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('data_table')->insert([
            'nama'=>$request->nama,
            'file'=>$file,
            'created_at'=>$createdAt
        ]);

        return redirect('data_table')->with('success','Berhasil membuat data table');
    }

    public function edit($id)
    {
        $data = DB::table('data_table')->where('id',$id)->first();
        if(!$data)
        {
            return redirect('data_table')->with('error','Gagal mendapatkan data table');
        }
        return view('data_table.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        if($request->file('file') != null)
        {
            $file = $this->uploadFile($request,'file');
            $execute = $this->readAnCreateTable($file);
            if(!is_bool($execute))
            {
                $execute = preg_replace("/[^A-Za-z0-9 ]/", '', $execute);
                unlink('asset_application/soal/'.$file);
                return redirect()->back()->with('error',$execute);
            }
        }else
        {
            $data = DB::table('data_table')->where('id',$id)->first();
            $file = $data->file;
        }
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('data_table')->where('id',$id)->update([
            'nama'=>$request->nama,
            'file'=>$file,
            'updated_at'=>$updatedAt
        ]);
        return redirect('data_table')->with('success','Berhasil mengubah data table');
    }

    public function delete($id)
    {
        DB::table('data_table')->where('id',$id)->delete();
        return redirect('data_table')->with('success','Berhasil menghapus data table');
    }

    public function uploadFile(Request $request, $oke)
    {
        $result = '';
        $file = $request->file($oke);
        $name = $file->getClientOriginalName();
        $extension = explode('.', $name);
        $extension = strtolower(end($extension));
        $key = rand() . '_' . $oke . '_table';
        $tmp_file_name = "{$key}.{$extension}";
        $tmp_file_path = "asset_application/soal";
        $file->move($tmp_file_path, $tmp_file_name);
        $result = $tmp_file_name;
        return $result;
    }

    public function readAnCreateTable($file)
    {
        $file = file_get_contents('asset_application/soal/'.$file);
        try { 
          $execute = DB::unprepared($file);
        } catch(\Illuminate\Database\QueryException $ex){ 
          $execute = $ex->getMessage(); 
        }
        return $execute;
    }
}
