<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Reportes;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Usuarios as Usuarios;
class ExcelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{      
		return view('reportes.reportes');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		  //$tipoReporte = $request->get('tipo');
	   $rows = \DB::table('reporte')->get();

		\Excel::create('test',function($excel)
		{
			$excel->sheet('testing',function($sheet)
			{
				$lin=Auth::user()->linea;
				$fecha=date("Y-m-d");
		   	$partescol=Reportes::where('linea','=',$lin)->get();
				$sheet->fromArray($partescol);
			});
		})->store('xlsx');
		return \Redirect::route('excel.index')->with('message','El archivo ha sido exportado correctamente');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		
	 
		

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
	   $tipoReporte = $request->get('tipo');
	   $rows = \DB::table($tipoReporte)->paginate(15);
	 
		/*\Excel::create('test',function($excel)
		{
			$excel->sheet('testing',function($sheet)
			{
				$lin=Auth::user()->linea;
				$fecha=date("Y-m-d");
		   	$partescol=Reportes::where('linea','=',$lin)->get();
				$sheet->fromArray($partescol);
			});
		})->store('xlsx');
		*/

		return view('reportes.exportar',compact('rows'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
