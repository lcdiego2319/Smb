<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\dwcrRequest;
use App\Reportes;
use App\dwcr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class DwcrController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lin=Session::get('linea');
		$last=\DB::table('dwcr')->where('linea',$lin)->first();
		$now=Carbon::now();
		$from= new Carbon($last->updated_at);
		$dwcr=$now->diff($from)->days;
		$target=\DB::table('dwcr')->select('target','best')->where('linea',$lin)->first();
		return view('dwcr.dwcrView',compact('dwcr',$dwcr))->with('target',$target);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('dwcr.dwcrinput');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{	$lin=Session::get('linea');
		$last=\DB::table('dwcr')->where('linea',$lin)->first();
		$now=Carbon::now();
		$from= new Carbon($last->updated_at);
		$dwcr=$now->diff($from)->days;
		$target=\DB::table('dwcr')->select('target','best')->where('linea',$lin)->first();
		return view('dwcr.dwcr',compact('dwcr',$dwcr))->with('target',$target);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$fecha=date("Y-m-d");
		$lin=Session::get('linea');
		dwcr::where('linea','=',$lin)->update(['fecha'=>$fecha]);


		return redirect('dwcr/show');
	
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