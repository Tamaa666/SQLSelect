<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Session;
class NilaiExport implements FromView
{
    public function view(): View
    {
        $data = Session::get('data');
        $materi = Session::get('materi');
        $now = Session::get('now');
        $paket = Session::get('paket');
        $pernah = Session::get('pernah');
        $soalPertama = Session::get('soalPertama');
        $nilai = Session::get('nilai');
        $percobaan = Session::get('percobaan');
        return view('nilai.report', compact('data','materi','now','paket','pernah','soalPertama','nilai','percobaan'));
    }
}
