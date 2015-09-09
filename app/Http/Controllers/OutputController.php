<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\lineas as lineas;
use App\partes;
use App\Reportes;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\reporteRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class OutputController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$lin=Auth::user()->linea;
		$fecha=date("Y-m-d");
		$partescol=Reportes::where('linea','=',$lin)->where('fecha',$fecha)->get();
       	$npartes=partes::select('id_parte','numparte')->where('linea','=',$lin)->get();
  		
  		return view('horaxhora.horaxhoraView')->with(array('partescol'=>$partescol,'npartes'=>$npartes));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$lin=Auth::user()->linea;
       $fecha=date("Y-m-d");

       $partescol=Reportes::where('linea','=',$lin)->where('fecha',$fecha)->get();
       $npartes=partes::select('id_parte','numparte')->where('linea','=',$lin)->get();
       
  	
  	return view('horaxhora.horaxhora')->with(array('partescol'=>$partescol,'npartes'=>$npartes));
  	
    }
 

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{	
		 $lin=Auth::user()->linea;
      	 $fecha=date("Y-m-d");
		 $acumuladas=\DB::table('reporte')->where('linea','=',$lin )->where('fecha','=',$fecha)->sum('pzsprod');

        $reporte= new Reportes();
        $reporte->fecha=date("Y-m-d");
        $reporte->linea=$lin;
        $reporte->numparte=$request->numparte;
        $reporte->horai=$request->hora;
        $reporte->pzsacum=$acumuladas;
        $reporte->save();

        return redirect('reporte/create');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		
		return view('horaxhora.horaxhora');
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
	public function UpdateComments(Request $request){

		$idc=$request->idc;
		$nuevo=$request->nuevo;
		Reportes::where('id_reporte','=',$idc)->update(['comentarios'=>$nuevo]);
		return redirect('reporte/create');
	}

	public function UpdateProduction(Request $request){
		
		$idp=$request->idp;                  
		$nuevo=$request->nuevo;
		$idLinea = $request->idlinea;
			$hora=date("H:i");//OBTENER LA HORA EN QUE SE HACE EL REGISTRO DE LA PRODUCCION 
			$temp=\DB::table('reporte')->where('id_reporte','=',$idp)->first();//TRAER EL ULTIMO REGISTRO EN LA TABLA REPORTES. DE AQUI SE OBTIENE EL CAMPO DE CREACION DEL REGISTRO
			$bn=\DB::table('partes')->select('bn')->where('numparte','=',$temp->numparte)->first();//OBTENER EL TIEMPO DE CUELLO DE BOTELLA PARA HACER EL CALCULO DE PIEZAS ESPERADAS
			$horai=new Carbon($temp->created_at);//INICIO DE LA PRODUCCION
			$horaf=new Carbon($hora);//FIN DE LA PRODUCCION (H5*60ORA POR HORA) 
			$min=$horaf->diffInMinutes($horai);//RESTA PARA OBTENER EL TIEMPO EN SEGUNDOS
			$programadas=round((($min*60)/$bn->bn)*.85,0,PHP_ROUND_HALF_UP);//CALCULO DE HORAS PROGRAMADAS, SE DIVIDE EL TOTAL DEL TIEMPO EN SEGUNDOS ENTRE EL CUELLO DE BOTELLA Y SE MULTIPLICA POR .85 (TIEMPO "COMODIN")
			//dd($horaf);
			Reportes::where('id_reporte','=',$idp)->update(['pzsprod'=>$nuevo,'horaf'=>$hora,'pzsprog'=>$programadas]);// SE ACTUALIZA EL REGISTRO AGREGANDO LAS PIEZAS PRODUCIDAS, LAS ESPERADAS Y LA HORA EN QUE FINALIZA LA PRODUCCION
				if($programadas>=$nuevo)
				{

					lineas::where('idlinea','=',$idLinea)->update(['andon' => 'yellow']);
					session(['andon'=>'yellow']);
				}
				else
				{
					lineas::where('idlinea','=',$idLinea)->update(['andon' => 'green']);
					session(['andon'=>'ok']);
				}

			return redirect('reporte/create');
	}

	public function UpdateFails(Request $request){

			$idm=$request->idm;
			$nuevo=$request->nuevo;
			Reportes::where('id_reporte','=',$idm)->update(['pzsmalas'=>$nuevo]);
			return redirect('reporte/create');
	}

	public function postRefresh(Request $request)
	{
		

	}
}
 