<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\usuarios;
use App\lineas;
use App\Http\Requests\Registro;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use Illuminate\Support\Facades\Session;
class Auth_smb extends Controller 
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    Public function getRegister(){
        return view('pages.register');
    }


    Public function postRegister(Request $request){
        $check=\DB::table('usuarios')->where('username','=','$request->username')->get();
        if($check==NULL)
        {
                $validador=Validator::make($request->all(),[
                    'username'=>'required|alpha_num|size:8|min:1',
                    'password'=>'required|min:1|confirmed'
                ]);
                if($validador->fails()){
                    return redirect('iniciar-sesion')->withErrors($validador)->withInput();
                }
                else{
                    $password=Hash::make($request->password);

                    $user= new usuarios();
                    $user->username=$request->username;
                    $user->password=$password;
                    $user->linea=$request->linea;
                    $user->remember_token=$request->_token;
                    $user->save();
                    return redirect('iniciar-sesion')->withInput();
                }
        }
        else{
            return redirect('iniciar-sesion');
        }
    }

    Public function getLogin(){

        $lineas=lineas::select('idlinea')->get();

        return view('pages.login')->with('lineas',$lineas);
    }

    Public function postLogin(){

        $pass=Input::get('pass');
        $linea=Input::get('linea');
        $username=Input::get('username');
        Session::put('linea',$linea);
        $credenciales=[
            'username'=>$username,
            'password'=>$pass,
            'linea'=>$linea];

           $validar=Auth::validate($credenciales);
           if(! $validar)
           {
                    return redirect('iniciar-sesion')->withErrors($validar)->withInput();
            }

           else{
               $auth= Auth::attempt(['username'=>$username,'password'=>$pass,'linea'=>$linea]);
                    if($auth)
                    {
                        Auth::loginUsingId(Auth::user()->username);
                        session(['andon'=>'ok','jidoka'=>'ok']);
                        return redirect()->route('reporte.create');
                    }
                    else
                        { 
                            return redirect('iniciar-sesion')->withErrors($auth)->withInput();
                        }
               }
         
           }

    Public function AdminLogin( Request $request){


        $credenciales=[
            'username'=>$request->username,
            'password'=>$request->pass];

           $validar=Auth::validate($credenciales);
           if(! $validar)
           {
                    return redirect('iniciar-sesion')->withErrors($validar)->withInput();
            }

           else{
               $auth= Auth::attempt(['username'=>$username,'password'=>$pass]);
                    if($auth)
                    {
                        Auth::loginUsingId(Auth::user()->username);
                        return redirect()->route('lineas.admin.create');
                    }
                    else
                        { 
                            return redirect('iniciar-sesion')->withErrors($auth)->withInput();
                        }
               }

    }
    Public function getLogout(){
        
        Auth::logout();
        
    }
    
}