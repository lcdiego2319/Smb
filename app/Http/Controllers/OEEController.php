<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reportes as Reportes;
use App\Http\Requests;
use App\Turno as Turno;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Auth;
use App\Oee as OEE;
use App\nsstops as nsstops;
class OEEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->createOEE();
        $today = Carbon::now();
        $startWeek = new Carbon('monday');
        if($today->diff($startWeek)->days != 0)
        {
            $startWeek = new Carbon('last monday');
        }
        $lastDay = OEE::orderBy('fecha','desc')->first();
        $dia = $lastDay->fecha;
        $oee = OEE::where('fecha','>=',$startWeek->toDateString())->where('fecha','<=',$lastDay->fecha)->orderBy('fecha')->get();
        $lastDay = new Carbon($dia);
        $diferencias = $lastDay->diff($startWeek)->days;

        $grafico = \Lava::DataTable();
        $grafico->addDateColumn('Data')
                ->addNumberColumn('Target')
                ->addNumberColumn('Turno1');
        for($i = 0; $i <= 5; $i++)
        {
            if($i == 0)
            {
                $grafico->addRow(array($startWeek->addDays(0),99,$oee[$i]->oee));
            }else if($i <= $diferencias)
            {
                $grafico->addRow(array($startWeek->addDays(1),99,$oee[$i]->oee));
            }else
            {
                $grafico->addRow(array($startWeek->addDays(1),99,0));
            }
        }

        $linechart = \Lava::LineChart('Temps')
                ->dataTable($grafico)
                ->title('OEE')
                ->setOptions(array(
                      'lineWidth'=>6,
                     'fontSize' => 20
                     ));
                 return view('oee.oeeView',compact('oee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */ 
    
    public function createOEE()
    {
        $today = Carbon::now();
         $lin=Auth::user()->linea;
        $fecha=date("Y-m-d");
        $producidas=Reportes::where('linea','=',$lin)->where('fecha',$fecha)->sum('pzsprod');
        $malas = Reportes::where('linea','=',$lin)->where('fecha',$fecha)->sum('pzsmalas');
        $buenas = $producidas - $malas;
        $calidad = $buenas / $producidas;//CALIDAD
        $programadas = Reportes::where('linea','=',$lin)->where('fecha',$fecha)->sum('pzsprog');
        if($programadas > 0)
        {
            $eficiencia = $producidas / $programadas;//EFICIENCIA
           // echo $eficiencia." ";
            $hora = date("H:i");
            $infoTurno= Turno::where('entrada','<=', $hora )->where('salida','>=',$hora)->first();
            $entrada = $infoTurno->entrada;
            $salida = $infoTurno->salida;
            $entrada = new Carbon($entrada);
            $salida = new Carbon($salida);
            $downtime = nsstops::where('created_at','>',$entrada)->where('updated_at','<',$salida)->where('razon','=','equipo')->sum('tiempo');
            $disponibilidad = ((2500/5)-$downtime)/(2500/5);//DISPONIBILIDAD
            $oee= $calidad * $eficiencia * $disponibilidad;
            $oee = $oee * 100;

            if($infoTurno->turno == 1)
            {
                $exist = OEE::where('fecha','=',$today->toDateString())->get();          
                if(!$exist->isEmpty())
                {
                     $exist = OEE::where('fecha','=',$today->toDateString())->update(['oee'=>$oee,'eficiencia'=>$eficiencia*100, 'calidad'=>$calidad * 100,'disponibilidad'=>$disponibilidad * 100]);          
                }else
                {                  
                    $oeeRegister = new Oee();
                    $oeeRegister->eficiencia = $eficiencia * 100;
                    $oeeRegister->disponibilidad = $disponibilidad * 100;
                    $oeeRegister->calidad = $calidad * 100;
                    $oeeRegister->oee = $oee;
                    $oeeRegister->fecha= $fecha;
                    $oeeRegister->turno = $infoTurno->turno;
                    $oeeRegister->save();
                }
            }
        }else
        {
            dd("division entre cero no es posible");
        }
    }
    public function create()
    {
        $this->createOEE();
        $today = Carbon::now();
        $startWeek = new Carbon('monday');
        if($today->diff($startWeek)->days != 0)
        {
            $startWeek = new Carbon('last monday');
        }

        $lastDay = OEE::orderBy('fecha','desc')->first();
        $dia = $lastDay->fecha;
        $oee = OEE::where('fecha','>=',$startWeek->toDateString())->where('fecha','<=',$lastDay->fecha)->orderBy('fecha')->get();
        $lastDay = new Carbon($dia);
        $diferencias = $lastDay->diff($startWeek)->days;

        $grafico = \Lava::DataTable();
        $grafico->addDateColumn('Data')
                ->addNumberColumn('Target')
                ->addNumberColumn('Turno1');
                
        for($i = 0; $i <= 5; $i++)
        {
            if($i == 0)
            {
                $grafico->addRow(array($startWeek->addDays(0),99,$oee[$i]->oee));
            }else if($i <= $diferencias)
            {
                $grafico->addRow(array($startWeek->addDays(1),99,$oee[$i]->oee));
            }else
            {
                $grafico->addRow(array($startWeek->addDays(1),99,0));
            }
        }
        $linechart = \Lava::LineChart('Temps')
                ->dataTable($grafico)
                ->title('OEE')
                ->setOptions(array(
                      'lineWidth'=>6,
                     'fontSize' => 20
                     ));
        return view('oee.oee',compact('oee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
