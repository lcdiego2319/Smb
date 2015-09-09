<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lineas as lineas;
use App\Turno as Turno;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TurnoController extends Controller
{   
    public function getTurno(Request $request)
    {
        $hora = date("H:i");
        $infoTurno= Turno::where('entrada','<=', $hora )->where('salida','>=',$hora)->first();
        $turno = $infoTurno->turno;
        if($request->ajax())
        {
            return response() ->json([
                'turno' => $turno
            ]);
        }
    }
}
