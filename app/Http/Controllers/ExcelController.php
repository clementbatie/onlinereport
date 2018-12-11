<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Collection;
class ExcelController extends Controller
{
	public function excel (){
		if (!session('output')) {
			return back();
		}
		
		$output = session('output');
		$a = \DB::select($output);	
	//	dd($a);
		return \Excel::create('report', function($excel) use($a){
			$excel->sheet('Sheetname', function($sheet) use($a){

				$data = array();
				foreach ($a as $result) {
					$data[] = (array)$result;  
				}

				$sheet->fromArray($data);
			});
		})->export('xls');;
	}
}
