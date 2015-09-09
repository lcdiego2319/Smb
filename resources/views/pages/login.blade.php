@extends('principal/layout')

@section('content')
 <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
         <div class="panel panel-warning"  >
            <div class="panel-heading" style="font-size:18px;background-color:#FFBF00">Acceso</div>
               <div class="panel-body">
                  {!! Form::open(array('route'=> 'getin','method'=>'post'))!!}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  {!! Form::label('fecha','Fecha:')!!}
                  <br>
                  {!! Form::text('fecha',date("Y-m-d"),array('class'=>'form-control','readonly'=>'readonly'))!!}
                  <br><br>
                  <div class="form-group">
                     {!! Form::label('Linea:')!!}
                     <br>
                     <select class="form-control" name="linea">
                        @foreach($lineas as $linea)
                           <option value="{{$linea->idlinea}}">{{$linea->idlinea}}</option>
                         @endforeach
                     </select>
                  </div>
                  <br>
                  {!! Form::label('user','UID:')!!}
                  <br>
                  {!! Form::text('username','',array('class'=>'form-control','required'=>'required'))!!}
                  <br>
                  {!! Form::label('pass','Contraseña:')!!}
                  <br>
                  {!! Form::password('pass',['class'=>'form-control','required'=>'required'])!!}
                  <br>
                 
               </div>
               <div class="panel-footer" >
                  <div class="row">
                     <div class="col-md-4 col-md-offset-4 text-center">
                        {!! Form::submit('Entrar', array('class'=>'btn btn-warning btn-block'))!!}
                        {!! Form::close()!!}
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
       
</div>
     
@if (count($errors) > 0)
      <div class="alert alert-danger col-lg-4 errores">
         <strong>Whoops!</strong> Hay algunos problemas con los campos.<br><br>
         <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
                   @endforeach
         </ul>
      </div>
@endif



@endsection                                                 
<div class="modal fade " id="nuevo">
        <div class="modal-dialog">
            <div class="modal-content hxh col-lg-8 ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h2 class="modal-tittle">Registro de usuarios</h2>
                    <div class="modal-body  responsive">
                    {!! Form::open(array('route'=> 'register','method'=>'post'))!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {!! Form::label('user','UID:')!!}
                    <br>
                    {!! Form::text('username','',array('class'=>'form-control'))!!}
                    <br><br>
                     <div class="form-group">
                        {!! Form::label('Linea:')!!}
                        <br>
                        <select class="form-control" name="linea">
                         @foreach($lineas as $linea)
                                 <option value="{{$linea->idlinea}}">{{$linea->idlinea}}</option>
                         @endforeach
                         </select>
                    </div><br><br>
                    {!! Form::label('password','Contraseña:')!!}
                    <br>
                    {!! Form::password('password',['class'=>'form-control'])!!}
                    <br><br>
                    {!! Form::label('pass','Confirmar Contraseña:')!!}
                    <br>
                    {!! Form::password('password_confirmation',['class'=>'form-control'])!!}
                    <br>
                    </div>
                    <div class="modal-footer">
                    {!! Form::submit('Guardar', array('class'=>'btn btn-primary'))!!}
                    {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>

