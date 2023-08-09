<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
use Shuchkin\SimpleXLSX;
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

    public function import(Request $request)
    {
        $file = $this->uploadFile($request,'file');
        if ( $xlsx = SimpleXLSX::parse('asset_application/import/data/'.$file)) {
            $header_values = $rows = [];
            foreach ( $xlsx->rows() as $k => $r ) {
                if ( $k === 0 ) {
                    $header_values = $r;
                    continue;
                }
                $rows[] = array_combine( $header_values, $r );
            }
            
            foreach ($rows as $key => $value) 
            {
               $checkKelas = DB::table('kelas')->where('id',$rows[$key]['ID_KELAS'])->first();
               if(!$checkKelas)
               {
                    return redirect()->back()->with('error','Gagal mengimport data ID_KELAS '.$rows[$key]['ID_KELAS'].' tidak ditemukan mohon perbaiki file anda dan check apakah ID_KELAS yang anda masukkan ada di daftar table kelas di menu kelas');
               }

               $checkMhs = DB::table('users')->where('username',$rows[$key]['NIM'])->first();
               if($checkMhs)
               {
                    return redirect()->back()->with('error','Gagal mengimport data NIM '.$rows[$key]['ID_KELAS'].' sudah digunakan mohon perbaiki file anda');
               }
            }

            $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            foreach ($rows as $key => $value)
            {
                $userId = DB::table('users')->insertGetId([
                            'role'=>'mahasiswa',
                            'username'=>$rows[$key]['NIM'],
                            'name'=>$rows[$key]['NAMA'],
                            'password'=>bcrypt($rows[$key]['NIM']),
                            'created_at'=>$createdAt
                        ]);

                        DB::table('mahasiswa')->insert([
                            'user_id'=>$userId,
                            'kelas_id'=>$rows[$key]['ID_KELAS'],
                            'nama'=>$rows[$key]['NAMA'],
                            'nim'=>$rows[$key]['NIM'],
                            'created_at'=>$createdAt
                        ]);
            }
        }else
        {
            return redirect()->back()->with('error','Gagal mengimport data salah pada alamat url');
        }

        return redirect()->back()->with('success','Berhasil mengimport data mahasiswa');
    }

    public function uploadFile(Request $request, $oke)
    {
        $result = '';
        $file = $request->file($oke);
        $name = $file->getClientOriginalName();
        $extension = explode('.', $name);
        $extension = strtolower(end($extension));
        $key = rand() . '_' . $oke . '_import_data_mhs';
        $tmp_file_name = "{$key}.{$extension}";
        $tmp_file_path = "asset_application/import/data";
        $file->move($tmp_file_path, $tmp_file_name);
        $result = $tmp_file_name;
        return $result;
    }
}
