<?php namespace App\Http\Controllers;

use App\actionplan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests\actionplanRequest;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;

class ActionplanController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lin= Auth::user()->linea;
        $apreport=actionplan::where('linea','=',$lin)->where('problemstatus','<>','Check')->get();
        $today = Carbon::now();
        $x = 0;
        foreach($apreport as $apre)
        {
       		$vencimiento = new Carbon($apre->vencimiento);
        	$diferencia = $today->diff($vencimiento)->days;
        	if($today < $vencimiento)
        	{
         		$apre->color = "green";
         		$apre->save();
        		
        	}else if($diferencia == 0)
        	{
        		$apre->color = "yellow";
         		$apre->save();
        
        	}else
        	{
				$apre->color = "red";
         		$apre->save();
        			
        	}
        	
        }

        return view('actionplan.actionplanView')->with('apreport',$apreport);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
       
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $ap= new actionplan();
        $ap->linea=Session::get('linea');
        $ap->problema=Input::get('problema');
        $ap->accion=Input::get('accion');
        $ap->responsable=Input::get('responsable');
        $ap->vencimiento=Input::get('fecha');
        $ap->problemstatus=Input::get('status');
        $ap->save();
       return redirect('actionplan/show');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		$lin= Auth::user()->linea;
		$today = Carbon::now();
        $apreport=actionplan::where('linea','=',$lin)->where('problemstatus','<>','Check')->get();

        $x = 0;
        foreach($apreport as $apre)
        {
       		$vencimiento = new Carbon($apre->vencimiento);
        	$diferencia = $today->diff($vencimiento)->days;
        	if($today < $vencimiento)
        	{
         		$apre->color = "green";
         		$apre->save();
        		
        	}else if($diferencia == 0)
        	{
        		$apre->color = "yellow";
         		$apre->save();
        
        	}else
        	{
				$apre->color = "red";
         		$apre->save();
        			
        	}
        	
        }

        return view('actionplan.actionplan')->with('apreport',$apreport);
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
	public function update(Request $request)
	{
		$id=Input::get('idac');
		$problemstatus=Input::get('stat');
		actionplan::where('numref',$id)->update(['problemstatus'=>$problemstatus]);

		return redirect('actionplan/show');
	
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
