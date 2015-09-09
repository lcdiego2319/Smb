<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\mccr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Auth;
class MccrController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lin= Auth::user()->linea;
        $mccr=mccr::where('linea','=',$lin)->orderBy('updated_at','desc')->first();
        return view('mccr.mccrView')->with('mccr',$mccr);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$lin= Auth::user()->linea;
        $mccr=mccr::where('linea','=',$lin)->orderBy('created_at','desc')->get();
        return view('mccr.mccr')->with('mccr',$mccr);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$nuevo= new mccr();
		$nuevo->linea=Auth::user()->linea;
		$nuevo->fecha=date("Y-m-d");
		$nuevo->problema=Input::get('problema');
		$nuevo->causaraiz=Input::get('causa');
		$nuevo->aprendizaje=Input::get('aprendizaje');
		$nuevo->soluciones=Input::get('soluciones');
		$nuevo->save();
		return redirect('mccr/create');

        
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function update($id)
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
