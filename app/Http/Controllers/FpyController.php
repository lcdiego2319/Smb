<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turno;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reportes;
use App\Fpy;
use Carbon\Carbon;
class FpyController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $today = Carbon::now();
      $this->createFpy($today);//Funcion para calcular el FPY
      $startWeek = new Carbon('monday');
      if($today->diff($startWeek)->days != 0)
      {
        $startWeek = new Carbon('last monday');
      }
      //$startWeek = Fpy::where('dia','=',$today->toDateString())->value('startWeek'); 
        $lastDay = Fpy::orderBy('dia','desc')->first();//Obtener el ultimo dia que es posible calcular el FPY
       $dia = $lastDay->dia;
        $fpys = Fpy::where('dia','>=',$startWeek->toDateString())->where('dia','<=',$lastDay->dia)->orderBy('dia')->orderBy('idfpy')->get();//obtener los valores de los fpy desde el inicio de la semana hasta la fecha actual.
        $lastDay = new Carbon($dia);
      
        $diferencias = $lastDay->diff($startWeek)->days;
      
        $grafico = \Lava::DataTable();
        $grafico->addDateColumn('Data')
              ->addNumberColumn('Target')
              ->addNumberColumn('Turno1')
              ->addNumberColumn('Turno2')
              ->addNumberColumn('Turno3')
              ->addNumberColumn('Turno4');
          
        for($i = 0;$i <= 5; $i++)
        {   
          if($i == 0)
          {
            $grafico->addRow(array($startWeek->addDays(0),98,$fpys[$i]->valor1,$fpys[$i]->valor2,$fpys[$i]->valor3,$fpys[$i]->valor4));
          }else if($i <= $diferencias)
          {
            $grafico->addRow(array($startWeek->addDays(1),98,$fpys[$i]->valor1,$fpys[$i]->valor2,$fpys[$i]->valor3,$fpys[$i]->valor4));
          }else
          {
            $grafico->addRow(array($startWeek->addDays(1),98,0,0,0,0));
          } 
        }

            $linechart = \Lava::LineChart('Temps')
                  ->dataTable($grafico)
                  ->title('FPY')
                  ->setOptions(array(
                     'lineWidth'=>6,
                     'fontSize' => 20
                    
                    ));
      
        return view('FPY.fpyView',compact('fpys'));
        
  }

   
/*FUNCTION: Para calcular el FPY del turno y dia actual*/
    public function createFpy($today)
    {

   
        $today = Carbon::now();
        $numWeek = $today->weekOfYear;
        $hora = date("H:i");

        $infoTurno= Turno::where('entrada','<=', $hora )->where('salida','>=',$hora)->first();
        $entrada = $infoTurno->entrada;
        $salida = $infoTurno->salida;
        $turno = $infoTurno->turno;

        $producidas = Reportes::where('fecha','=',$today->toDateString())->where('horai','>=',$entrada)->where('horaf','<=',$salida)->sum('pzsprod');
        $rechazadas = Reportes::where('fecha','=',$today->toDateString())->where('horai','>=',$entrada)->where('horaf','<=',$salida)->sum('pzsmalas');
        if($producidas == 0)
        {
          return;

        }
        $fpy = ($producidas - $rechazadas) / $producidas;
        $fpy = $fpy * 100;

        if($turno == 1)
        {
          $exist = Fpy::where('dia','=',$today->toDateString())->get();
          if(!$exist->isEmpty())
          {
            $exist = Fpy::where('dia','=',$today->toDateString())->update(['valor1'=>$fpy]);
          }
          else
          {
            
            $monday = new Carbon('monday');
            if($today->diff($monday)->days != 0)
            {
              $monday = new Carbon('last monday');
            }
            $sunday = new Carbon('sunday');
            $guardar = new Fpy();
            $guardar->valor1 = $fpy;
            $guardar->turno1 = $turno;
            $guardar->dia = $today;
            $guardar->startWeek = $monday;
            $guardar->endWeek = $sunday;
            $guardar->numberWeek = $numWeek;
            $guardar->save();
          }          
        }
        if($turno == 2)
        {
          $exist = Fpy::where('dia','=',$today->toDateString())->get();
          if(!$exist->isEmpty())
          {
            $exist = Fpy::where('dia','=',$today->toDateString())->update(['valor2'=>$fpy]);
          }
          else
          {
            $monday = new Carbon('last monday');
            $sunday = new Carbon('sunday');
            $guardar = new Fpy();
            $guardar->valor2 = $fpy;
            $guardar->turno2 = $turno;
            $guardar->dia = $today;
            $guardar->startWeek = $monday;
            $guardar->endWeek = $sunday;
            $guardar->numberWeek = $numWeek;
            $guardar->save();
          }
        }
        if($turno == 3)
        {
          $exist = Fpy::where('dia','=',$today->toDateString())->get();
          if(!$exist->isEmpty())
          {
            $exist = Fpy::where('dia','=',$today->toDateString())->update(['valor3'=>$fpy]);
          }
          else
          {
            $monday = new Carbon('monday');
            $sunday = new Carbon('sunday');
            $guardar = new Fpy();
            $guardar->valor3 = $fpy;
            $guardar->turno3 = $turno;
            $guardar->dia = $today;
            $guardar->startWeek = $monday;
            $guardar->endWeek = $sunday;
            $guardar->numberWeek = $numWeek;
            $guardar->save();
          }
        }
        if($turno == 4)
        {
          $exist = Fpy::where('dia','=',$today->toDateString())->get();
          if(!$exist->isEmpty())
          {
            $exist = Fpy::where('dia','=',$today->toDateString())->update(['valor4'=>$fpy]);
          }
          else
          {
            $monday = new Carbon('monday');
            $sunday = new Carbon('sunday');
            $guardar = new Fpy();
            $guardar->valor4 = $fpy;
            $guardar->turno4 = $turno;
            $guardar->dia = $today;
            $guardar->startWeek = $monday;
            $guardar->endWeek = $sunday;
            $guardar->numberWeek = $numWeek;
            $guardar->save();
          }
        }
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $today = Carbon::now();
      $this->createFpy($today);//Funcion para calcular el FPY
      $startWeek = new Carbon('monday');
      if($today->diff($startWeek)->days != 0)
      {
        $startWeek = new Carbon('last monday');
      }
      //$startWeek = Fpy::where('dia','=',$today->toDateString())->value('startWeek'); 
        $lastDay = Fpy::orderBy('dia','desc')->first();//Obtener el ultimo dia que es posible calcular el FPY
       $dia = $lastDay->dia;
        $fpys = Fpy::where('dia','>=',$startWeek->toDateString())->where('dia','<=',$lastDay->dia)->orderBy('dia')->orderBy('idfpy')->get();//obtener los valores de los fpy desde el inicio de la semana hasta la fecha actual.
        $lastDay = new Carbon($dia);

        $diferencias = $lastDay->diff($startWeek)->days;
      
        $grafico = \Lava::DataTable();
        $grafico->addDateColumn('Data')
              ->addNumberColumn('Target')
              ->addNumberColumn('Turno1')
              ->addNumberColumn('Turno2')
              ->addNumberColumn('Turno3')
              ->addNumberColumn('Turno4');
          
        for($i = 0;$i <= 5; $i++)
        {   
          if($i == 0)
          {
            $grafico->addRow(array($startWeek->addDays(0),98,$fpys[$i]->valor1,$fpys[$i]->valor2,$fpys[$i]->valor3,$fpys[$i]->valor4));
          }else if($i <= $diferencias)
          {
            $grafico->addRow(array($startWeek->addDays(1),98,$fpys[$i]->valor1,$fpys[$i]->valor2,$fpys[$i]->valor3,$fpys[$i]->valor4));

          }else
          {
            $grafico->addRow(array($startWeek->addDays(1),98,0,0,0,0));
          } 
        }

            $linechart = \Lava::LineChart('Temps')
                  ->dataTable($grafico)
                  ->title('FPY')
                  ->setOptions(array(
                     'lineWidth'=>6,
                     'fontSize' => 20
                    
                    ));
        return view('FPY.fpy',compact('fpys'));
        
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
