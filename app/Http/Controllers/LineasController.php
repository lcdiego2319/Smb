<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lineas as lineas;
use App\Http\Controllers\Controller;
use Auth;
class LineasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $lineas=lineas::paginate();
        return view('Lineas.lineas',compact('lineas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $linea= new lineas();
        $linea->idlinea=$request->idlinea;
        $linea->nombre=$request->nombre;
        $linea->save();
        return redirect('lineas/admin/create');
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
    public function destroy($id, Request $request)
    {

        
    }

    public function getAndon(Request $request)
    { 
        $idLinea = Auth::user()->linea;
        $andonStatus = lineas::where('idlinea','=',$idLinea)->value('andon');
      
        if($request->ajax())
        {
            return response()->json([
                    'andon' => $andonStatus
                ]);

        }
       
    }
}
