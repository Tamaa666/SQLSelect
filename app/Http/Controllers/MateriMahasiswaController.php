<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class MateriMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
    {
        $data = DB::table('materi')->get();
        return view('materi_mahasiswa.index',compact('data'));
    }

}
