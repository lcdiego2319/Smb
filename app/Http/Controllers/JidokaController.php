<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nsstops as nsstops;
use App\Http\Requests;
use App\lineas as lineas;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
class JidokaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         $last= \DB::table('nsstops')->where('status','=',1)->orderBy('created_at','desc')->first();
        $triangulo = "images/triangulo1.png";
       if($last!=null)
       {
            $created_at= new Carbon($last->created_at);
            $jidoka=Carbon::now()->diffInMinutes($created_at);
            if($jidoka>=0&&$jidoka<=1)
            {
                $triangulo = 'images/triangulo2.png';
            }elseif($jidoka>1&&$jidoka<=2)
                    {
                        $triangulo = 'images/triangulo3.png';
                    }elseif($jidoka>2&&$jidoka<=3)
                            {
                                $triangulo = 'images/triangulo4.png';
                            }elseif($jidoka>3&&$jidoka<=4)
                                    {
                                        $triangulo = 'images/triangulo5.png';
                                    }else{
                                            $triangulo = 'images/triangulo6.png';
                                        }
            return view('jidoka.jidokaView',compact('triangulo'));
        }
        return view('jidoka.jidokaView',compact('triangulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
   

       $last= \DB::table('nsstops')->where('status','=',1)->orderBy('created_at','desc')->first();
        $triangulo = "images/triangulo1.png";
       if($last!=null)
       {
            $created_at= new Carbon($last->created_at);
            $jidoka=Carbon::now()->diffInMinutes($created_at);
            if($jidoka>=0&&$jidoka<=1)
            {
                $triangulo = 'images/triangulo2.png';
            }elseif($jidoka>1&&$jidoka<=2)
                    {
                        $triangulo = 'images/triangulo3.png';
                    }elseif($jidoka>2&&$jidoka<=3)
                            {
                                $triangulo = 'images/triangulo4.png';
                            }elseif($jidoka>3&&$jidoka<=4)
                                    {
                                        $triangulo = 'images/triangulo5.png';
                                    }else{
                                            $triangulo = 'images/triangulo6.png';
                                        }
            return view('jidoka.jidoka',compact('triangulo'));
        }
        return view('jidoka.jidoka',compact('triangulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function store(Request $request)
    {

        $data = new nsstops();
        $data->linea=Auth::user()->linea;
        $data->razon = $request->tipo;
        $data->status = 1;
        $data->save();
        lineas::where('idlinea','=',$data->linea)->update(['andon'=>'red']);
        session(['andon'=>'red','jidoka'=>'first']);
        return redirect('jidoka/create');
        
    } 

    public function reset(){
       //\DB::table('nsstops')->delete();
        $lastStop = nsstops::orderBy('created_at','desc')->first();
        $startStop = new Carbon($lastStop->created_at);
        $currentTime = Carbon::now();

        $time = $startStop->diffInMinutes($currentTime);

        $lastStop->tiempo = $time;
        $lastStop->status = 0;
        $lastStop->save();
     
       $reporte = \DB::table('reporte')->orderBy('cambio','desc')->first();
        $programadas = $reporte->pzsprog;
        $producidas = $reporte->pzsprod;
        $linea = Auth::user()->linea;

        if($producidas > $programadas)
        {
             lineas::where('idlinea','=',$linea)->update(['andon'=>'green']);
        }else
        {
             lineas::where('idlinea','=',$linea)->update(['andon'=>'yellow']);
        }
         return redirect('jidoka/create');
    }

    public function postRefresh(Request $request)
    {
        $last= \DB::table('nsstops')->where('status','=',1)->orderBy('created_at','desc')->first();
        $triangulo = 'images/triangulo1.png';
       if($last!=null)
       {
            $created_at= new Carbon($last->created_at);
            $jidoka=Carbon::now()->diffInMinutes($created_at);
            
            if($jidoka>=0&&$jidoka<=1)
            {
                $triangulo = 'images/triangulo2.png';
            }
            elseif($jidoka>1&&$jidoka<=2)
            {
                 $triangulo = 'images/triangulo3.png';
                session(['jidoka'=>'second']);}
            elseif($jidoka>2&&$jidoka<=3)
            {
                $triangulo = 'images/triangulo4.png';
                session(['jidoka'=>'third']);
            }
            elseif($jidoka>3&&$jidoka<=4)
            {
                $triangulo = 'images/triangulo5.png';
                session(['jidoka'=>'fourth']);
            }
            else
            {
                $triangulo = 'images/triangulo6.png';
                session(['jidoka'=>'fifth']);
            }
        }
        
        if($request->ajax()){
            return response()->json([             
                    'message' => $triangulo
                ]); 
        }
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
