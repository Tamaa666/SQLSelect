<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
class TestCodeController extends Controller
{
	public function test()
	{
		$query = 'SELECT DISTINCT nilai_huruf FROM nila';
		try { 
            $sqlJawaban = DB::select($query);
        } catch(\Illuminate\Database\QueryException $ex){ 
            $sqlJawaban = $ex->getMessage(); 
        }

        dd($sqlJawaban);
	}
}